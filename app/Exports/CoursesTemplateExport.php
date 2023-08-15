<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
// use Maatwebsite\Excel\Concerns\WithCustomStartRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;


class CoursesTemplateExport implements WithCustomStartCell ,WithHeadings,WithStyles ,WithColumnWidths,WithEvents,WithColumnFormatting
{
    protected $category , $kitchen , $unit;
    public function __construct($category, $kitchen, $unit)
    {
        $this->kitchen = $kitchen;
        $this->category = $category;
        $this->unit = $unit;
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function headings(): array
    {
        return [
            'Tên món ăn',
            'Mã món ăn',
            'Danh mục',
            'Cách chế biến',
            'Cách tính điểm',
            'Gửi bếp/bar',
            'Thời gian nấu (phút)',
            'Đơn vị',
            'Cách bán',
            'Đánh giá món',
            'Ứng dụng Aloline',
            'Giá bán',
            'Điểm quy đổi',
            'Hình thức bán',
            'Loại món',
            'Món bán kèm'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 20,
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 30,
            'L' => 30,
            'M' => 30,
            'N' => 30,
            'O' => 30,
            'P' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A5')->getFont()->setBold(true);
        $sheet->getStyle('B5')->getFont()->setBold(true);
        $sheet->getStyle('C5')->getFont()->setBold(true);
        $sheet->getStyle('D5')->getFont()->setBold(true);
        $sheet->getStyle('E5')->getFont()->setBold(true);
        $sheet->getStyle('F5')->getFont()->setBold(true);
        $sheet->getStyle('G5')->getFont()->setBold(true);
        $sheet->getStyle('H5')->getFont()->setBold(true);
        $sheet->getStyle('I5')->getFont()->setBold(true);
        $sheet->getStyle('J5')->getFont()->setBold(true);
        $sheet->getStyle('K5')->getFont()->setBold(true);
        $sheet->getStyle('L5')->getFont()->setBold(true);
        $sheet->getStyle('M5')->getFont()->setBold(true);
        $sheet->getStyle('N5')->getFont()->setBold(true);
        $sheet->getStyle('O5')->getFont()->setBold(true);
        $sheet->getStyle('P5')->getFont()->setBold(true);
        $sheet->getStyle('Q5')->getFont()->setBold(true);
    }
    // Formatting
    public function columnFormats(): array
    {
        return [
            'M' => NumberFormat::FORMAT_NUMBER,
        ];
    }


    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A5:F5')->applyFromArray(
                    [
                        'font' => [
                            'bold' => true,
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ]
                    ]
                );

                $event->sheet->getDelegate()->getStyle('A5:P5')->applyFromArray(
                    [
                        'font' => [
                            'bold' => true,
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        ],
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ],
                        'background' => [
                            'color'=> '#000000',
                        ]
                    ]
                );

                $event->sheet->getDelegate()->getStyle('A6:P44')->applyFromArray(
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '00000000'],
                            ],
                        ],
                    ]
                );


                $name_category = [];
                $name_kitchen = [];
                $name_unit = [];
                for($i = 0 ; $i < count($this->category) ; $i++){
                    array_push($name_category , $this->category[$i]['name'].'|('.$i.')' );
                };
                for($i = 0 ; $i < count($this->kitchen) ; $i++){
                    array_push($name_kitchen ,$this->kitchen[$i]['name'].' - ('. $i.')');
                }
                for($i = 0 ; $i < count($this->unit) ; $i++){
                    array_push($name_unit , $this->unit[$i]['name'].' - ('. $i.')');
                }
                $options_food = $name_category;
                // dd($tring);
                $options_cook = [
                    'Món nấu - (0)',
                    'Món nướng - (1)',
                    // 'Món chế biến - (-1)',
                ];
                $options_poit_method = [
                    'Theo hoá đơn - (0)',
                    'Cho người gọi món - (1)',
                ];

                $options_print_crate = [
                    'Có gửi - (1)',
                    'Không gửi - (0)'
                ];
                $options_sell_crate = [
                    'Bán theo phần - (0)',
                    'Bán theo ký - (1)'
                ];
                $options_review_crate = [
                    'Không được đánh giá - (0)',
                    'Được đánh giá - (1)'
                ];

                $options_party_create = [
                    'Cho phép sử dụng điểm - (0)',
                    'Không cho phép sử dụng điểm - (1)'
                ];

                // Option Đơn vị
                $options_unit_create = $name_unit;

                // Option Hình thức bán
                $options_take_away_create = [
                    'Dùng tại chỗ - (0)',
                    'Mua mang đi - (1)',
                    'Cả 2 - (2)'
                ];

                // option Combo food
                $options_combo_food_create = [
                    'Món Thường - (0)',
                    'Món Kèm - (1)',
                ];

                // Danh mục
                for($i= 5; $i<= 44 ; $i++) {
                    //  Loại món ăn
                    $category_food = $event->sheet->getCell("C". $i)->getDataValidation();
                    $category_food->setType(DataValidation::TYPE_LIST );
                    $category_food->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $category_food->setAllowBlank(false);
                    $category_food->setShowInputMessage(true);
                    $category_food->setShowErrorMessage(true);
                    $category_food->setShowDropDown(true);
                    $category_food->setErrorTitle('Input error');
                    $category_food->setError('Value is not in list.');
                    $category_food->setPromptTitle('Loại Món Ăn');
                    $category_food->setPrompt('Vui lòng chọn loại món ăn');
                    $category_food->setFormula1(sprintf('"%s"',implode(',',$options_food)));

                    // Cách chế biến
                    $validation1 = $event->sheet->getCell("D".$i)->getDataValidation();
                     $validation1->setType(DataValidation::TYPE_LIST );
                     $validation1->setErrorStyle(DataValidation::STYLE_INFORMATION );
                     $validation1->setAllowBlank(false);
                     $validation1->setShowInputMessage(true);
                     $validation1->setShowErrorMessage(true);
                     $validation1->setShowDropDown(true);
                     $validation1->setErrorTitle('Input error');
                     $validation1->setError('Value is not in list.');
                     $validation1->setPromptTitle('Cách chế biến');
                     $validation1->setPrompt('Vui lòng chọn cách chế biến');
                     $validation1->setFormula1(sprintf('"%s"',implode(',',$options_cook)));


                    // Cách tính điểm
                    $poit_method = $event->sheet->getCell("E". $i)->getDataValidation();
                    $poit_method->setType(DataValidation::TYPE_LIST );
                    $poit_method->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $poit_method->setAllowBlank(false);
                    $poit_method->setShowInputMessage(true);
                    $poit_method->setShowErrorMessage(true);
                    $poit_method->setShowDropDown(true);
                    $poit_method->setErrorTitle('Input error');
                    $poit_method->setError('Value is not in list.');
                    $poit_method->setPromptTitle('Cách tính điểm');
                    $poit_method->setPrompt('Vui lòng chọn cách tính điểm');
                    $poit_method->setFormula1(sprintf('"%s"',implode(',',$options_poit_method)));

                    // Gửi bếp/bar
                    $print_create = $event->sheet->getCell("F". $i)->getDataValidation();
                    $print_create->setType(DataValidation::TYPE_LIST );
                    $print_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $print_create->setAllowBlank(false);
                    $print_create->setShowInputMessage(true);
                    $print_create->setShowErrorMessage(true);
                    $print_create->setShowDropDown(true);
                    $print_create->setErrorTitle('Input error');
                    $print_create->setError('Value is not in list.');
                    $print_create->setPromptTitle('Pick from list');
                    $print_create->setPrompt('Vui lòng chọn gửi bếp/bar');
                    $print_create->setFormula1(sprintf('"%s"',implode(',',$options_print_crate)));

                    // // Bếp
                    $kitchen_create = $event->sheet->getCell("H". $i)->getDataValidation();
                    $kitchen_create->setType(DataValidation::TYPE_LIST );
                    $kitchen_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $kitchen_create->setAllowBlank(false);
                    $kitchen_create->setShowInputMessage(true);
                    $kitchen_create->setShowErrorMessage(true);
                    $kitchen_create->setShowDropDown(true);
                    $kitchen_create->setErrorTitle('Input error');
                    $kitchen_create->setError('Value is not in list.');
                    $kitchen_create->setPromptTitle('Chọn Bếp');
                    $kitchen_create->setPrompt('Vui lòng chọn bếp');
                    $kitchen_create->setFormula1(sprintf('"%s"',implode(',',$name_kitchen)));

                    // Cách bán
                    $sell_create = $event->sheet->getCell("I". $i)->getDataValidation();
                    $sell_create->setType(DataValidation::TYPE_LIST );
                    $sell_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $sell_create->setAllowBlank(false);
                    $sell_create->setShowInputMessage(true);
                    $sell_create->setShowErrorMessage(true);
                    $sell_create->setShowDropDown(true);
                    $sell_create->setErrorTitle('Input error');
                    $sell_create->setError('Value is not in list.');
                    $sell_create->setPromptTitle('Chọn Cách Bán');
                    $sell_create->setPrompt('Vui lòng chọn cách bán');
                    $sell_create->setFormula1(sprintf('"%s"',implode(',',$options_sell_crate)));

                    //Đánh giá món
                    $review_create = $event->sheet->getCell("J". $i)->getDataValidation();
                    $review_create->setType(DataValidation::TYPE_LIST );
                    $review_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $review_create->setAllowBlank(false);
                    $review_create->setShowInputMessage(true);
                    $review_create->setShowErrorMessage(true);
                    $review_create->setShowDropDown(true);
                    $review_create->setErrorTitle('Input error');
                    $review_create->setError('Value is not in list.');
                    $review_create->setPromptTitle('Chọn đánh giá món');
                    $review_create->setPrompt('Vui lòng chọn đánh giá');
                    $review_create->setFormula1(sprintf('"%s"',implode(',',$options_review_crate)));

                    // Ứng dụng Aloline
                    $party_create = $event->sheet->getCell("K". $i)->getDataValidation();
                    $party_create->setType(DataValidation::TYPE_LIST );
                    $party_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $party_create->setAllowBlank(false);
                    $party_create->setShowInputMessage(true);
                    $party_create->setShowErrorMessage(true);
                    $party_create->setShowDropDown(true);
                    $party_create->setErrorTitle('Input error');
                    $party_create->setError('Value is not in list.');
                    $party_create->setPromptTitle('Chọn Dùng điểm');
                    $party_create->setPrompt('Vui lòng chọn dùng điểm');
                    $party_create->setFormula1(sprintf('"%s"',implode(',',$options_party_create)));

                    // Đơn vị
                    $unit_create = $event->sheet->getCell("H". $i)->getDataValidation();
                    $unit_create->setType(DataValidation::TYPE_LIST );
                    $unit_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $unit_create->setAllowBlank(false);
                    $unit_create->setShowInputMessage(true);
                    $unit_create->setShowErrorMessage(true);
                    $unit_create->setShowDropDown(true);
                    $unit_create->setErrorTitle('Lỗi rồi');
                    $unit_create->setError('Vui lòng chọn lại');
                    $unit_create->setPromptTitle('Chọn Đơn Vị');
                    $unit_create->setPrompt('Vui lòng chọn ứng đúng đơn vị');
                    $unit_create->setFormula1(sprintf('"%s"',implode(',',$options_unit_create)));

                    // Hình thức bán
                    $take_away_create = $event->sheet->getCell("N". $i)->getDataValidation();
                    $take_away_create->setType(DataValidation::TYPE_LIST );
                    $take_away_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $take_away_create->setAllowBlank(false);
                    $take_away_create->setShowInputMessage(true);
                    $take_away_create->setShowErrorMessage(true);
                    $take_away_create->setShowDropDown(true);
                    $take_away_create->setErrorTitle('Lỗi rồi');
                    $take_away_create->setError('Vui lòng chọn lại');
                    $take_away_create->setPromptTitle('Chọn');
                    $take_away_create->setPrompt('Vui lòng chọn hình thức');
                    $take_away_create->setFormula1(sprintf('"%s"',implode(',',$options_take_away_create)));

                    // Combo food
                    $combo_food_create = $event->sheet->getCell("O". $i)->getDataValidation();
                    $combo_food_create->setType(DataValidation::TYPE_LIST );
                    $combo_food_create->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $combo_food_create->setAllowBlank(false);
                    $combo_food_create->setShowInputMessage(true);
                    $combo_food_create->setShowErrorMessage(true);
                    $combo_food_create->setShowDropDown(true);
                    $combo_food_create->setErrorTitle('Lỗi rồi');
                    $combo_food_create->setError('Vui lòng chọn lại');
                    $combo_food_create->setPromptTitle('Chọn Đơn vị');
                    $combo_food_create->setPrompt('Vui lòng chọn ứng đúng đơn vị');
                    $combo_food_create->setFormula1(sprintf('"%s"',implode(',',$options_combo_food_create)));
                }
            },
        ];
    }
}
