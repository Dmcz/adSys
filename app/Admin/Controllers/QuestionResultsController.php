<?php

namespace App\Admin\Controllers;

use App\Models\QuestionResults;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QuestionResultsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Modles\QuestionResults';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QuestionResults);

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('所属用户'));
        $grid->column('contact_name', __('联系人姓名'));
        $grid->column('contact_mobile', __('联系人电话'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));


        $grid->disableCreateButton();

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
        $show = new Show(QuestionResults::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('所属用户'));
        $show->field('contact_name', __('联系人姓名'));
        $show->field('contact_mobile', __('联系人电话'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QuestionResults);

        $form->number('user_id', __('所属用户'));
        $form->text('contact_name', __('联系人姓名'));
        $form->text('contact_mobile', __('联系人电话'));

        return $form;
    }
}
