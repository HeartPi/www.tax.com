<?php

namespace App\Admin\Controllers;

use App\Model\IndentModel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Extensions\IndentExporter;

class IndentController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '订单管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new IndentModel());

        $grid->exporter(new IndentExporter);

        $grid->column('id', __('Id'));
        $grid->column('recognizee', __('被保人'));
        $grid->column('identity_card', __('身份号码'));
        $grid->column('license_plate_number', __('车牌号'));
        $grid->column('vin', __('车架号'));
        $grid->column('engine_number', __('发动机号'));
        $grid->column('record_date', __('登记日期'));
        $grid->column('nature', __('使用性质'));
        $grid->column('weight', __('总质量'));
        $grid->column('check_weight', __('核定质量'));
        $grid->column('equipment_quality', __('装备质量'));
        $grid->column('tax', __('税额'));
        $grid->column('status', __('数据状态'))->gender()->using([0 => '未支付', 2 => '已支付', 3 => '完成修改']);;
        $grid->column('file', __('税务文件'))->lightbox(['width' => 50, 'height' => 50]);
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(IndentModel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('recognizee', __('被保人'));
        $show->field('identity_card', __('身份号码'));
        $show->field('license_plate_number', __('车牌号'));
        $show->field('vin', __('车架号'));
        $show->field('engine_number', __('发动机号'));
        $show->field('record_date', __('登记日期'));
        $show->field('nature', __('使用性质'));
        $show->field('weight', __('总质量'));
        $show->field('check_weight', __('核定质量'));
        $show->field('equipment_quality', __('装备质量'));
        $show->field('tax', __('税额'));
        $show->field('status', __('数据状态'))->gender()->using([0 => '未支付', 2 => '已支付', 3 => '完成修改']);;
        $show->field('file', __('税务文件'))->image();
        $show->field('updated_at', __('更新时间'));
        $show->field('created_at', __('创建时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new IndentModel());

        $form->text('recognizee', __('被保人'));
        $form->text('identity_card', __('身份号码'));
        $form->text('license_plate_number', __('车牌号'));
        $form->text('vin', __('车架号'));
        $form->text('engine_number', __('发动机号'));
        $form->date('record_date', __('登记日期'))->default(date('Y-m-d'));
        $form->text('nature', __('使用性质'));
        $form->text('weight', __('总质量'));
        $form->text('check_weight', __('核定质量'));
        $form->text('equipment_quality', __('装备质量'));
        $form->text('tax', __('税额'));
        $form->select('status', __('数据状态'))->options([0 => '未支付', 2 => '已支付', 3 => '完成修改']);
        $form->multipleImage('file', '税务文件')->help('请上传图片')->removable();
        return $form;
    }
}
