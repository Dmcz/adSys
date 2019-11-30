<?php
namespace App\Admin\Exporters;

use Encore\Admin\Grid\Exporters\ExcelExporter; 

class QuestionResultsExporter extends ExcelExporter
{
    protected $fileName = '问卷结果.xlsx';

    protected $columns = [
        'id'      => 'ID',
        'user.name'   => '所属用户',
        'contact_name' => '联系人姓名',
        'contact_mobile' => '联系人电话',
        'created_at' => '创建时间',
    ];

}