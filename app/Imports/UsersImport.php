<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMappedCells;
//,WithHeadingRow
class UsersImport implements WithMappedCells,ToModel
{
//    private $rows = 0;
//    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
//    public function collection(Collection $rows){
//        foreach ($rows as $col){
//            $array=array(
//                'name' => $col[0],
//                'code' => $col[1],
//                'time_to_completed' => $col[2],
//                'unit' => $col[3],
//                'price' => $col[4],
//                'category_id' => $col[5],
//                'is_bbq' => $col[6],
//                'is_allow_purchase_by_point' => $col[7],
//                'is_sell_by_weight' => $col[8],
//                'is_allow_print' => $col[9],
//                'is_take_away' => $col[10],
//                'is_allow_review' => $col[11],
//                'is_special_claim_point' => $col[12],
//                'point_to_purchase' => $col[13],
//            );
//        }
//    }
    public function model(array $row)
    {
//        ++$this->rows;
        return new User(array(
            'name'=>$row[0],
            'email'=>$row[1],
            'password'=>$row[2],
//            'name' => $row[0],
//            'code' => $row[1],
//            'time_to_completed' => $row[2],
//            'unit' => $row[3],
//            'price' => $row[4],
//            'category_id' => $row[5],
//            'is_bbq' => $row[6],
//            'is_allow_purchase_by_point' => $row[7],
//            'is_sell_by_weight' => $row[8],
//            'is_allow_print' => $row[9],
//            'is_take_away' => $row[10],
//            'is_allow_review' => $row[11],
//            'is_special_claim_point' => $row[12],
//            'point_to_purchase' => $row[13],
        ));
//        return new User([
//            'name'     => $row[1],
//            'email'    => $row[2],
//            'password' => '',
//        ]);
    }
//    public function getRowCount(): int
//    {
//        return $this->rows;
//    }
    public function headingRow(): int
    {
        return 2;
    }

    /**
     * @inheritDoc
     */
    public function mapping(): array
    {
        return [
            'name'  => 'A1',
            'email' => 'B1',
        ];
        // TODO: Implement mapping() method.
    }
}
