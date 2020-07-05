<?php
namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter; 
use Maatwebsite\Excel\Concerns\WithMapping;

class IndentExporter extends ExcelExporter implements WithMapping
{
    protected $fileName = '订单列表.xlsx';

    protected $statsu_name_list = [0 => '未支付', 2 => '已支付', 3 => '完成修改'];

    protected $columns = [ 
        'id'=>'ID', 
        'recognizee'=>'被保人', 
        'identity_card'=>'身份号码', 
        'license_plate_number'=>'车牌号' , 
        'vin'=>'车架号', 
        'engine_number'=>'发动机号', 
        'record_date'=>'登记日期', 
        'nature'=>'使用性质', 
        'weight'=>'总质量', 
        'check_weight'=>'核定质量', 
        'equipment_quality'=>'装备质量', 
        'tax'=>'税额', 
        'status'=>'状态',
        'file'=>'税务文件', 

    ];
    /**
     * 字段处理
     *
     * @param object $user
     * @return array
     */
    public function map($user) : array
    {
        $statsu_name = '未支付';
        $statsu_name = $this->statsu_name_list[$user->status];
        
        return [
            $user->id,
            $user->recognizee,
            $user->identity_card,
            $user->license_plate_number,
            $user->vin,
            $user->engine_number,
            $user->record_date,
            $user->nature,
            $user->weight,
            $user->check_weight,
            $user->equipment_quality,
            $user->tax,
            $statsu_name,
            $user->file
        ];
    }
}