<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use \Illuminate\Support\Collection;

class PayrollExport implements FromCollection, WithHeadings
{
    public $data;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(array $data) {
        $this->data = $data;
    }

    public function collection()
    {
        //
        $ac = $this->data;
        return collect($ac);
    }

    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
        return ["Mã nhân viên", "Tên nhân viên", "Bộ phận", "Ca làm việc", "Lương cơ bản hiện tại", "Ngày công", "Nghỉ có phép", "Nghỉ không phép", "Điểm KPI", "Điểm bán hàng", "Lương theo ngày công", "Thưởng điểm bán hàng", "Thưởng khác", "Đánh giá món ăn (bếp viên)", "Đánh giá món ăn (bếp trưởng)", "Hỗ trợ", "Tổng thưởng", "Số phút trễ", "Tiền phạt trễ", "Ngày không check-out", "Phạt không check-out", "Các khoản phạt khác", "Tổng phạt", "Tiền đồng phục", "Tạm ứng", "Nợ/Sai bill", "Thực lãnh", "Tổng lương", "Trạng thái"];
    }
}
