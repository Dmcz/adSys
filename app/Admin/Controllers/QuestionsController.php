<?php

namespace App\Admin\Controllers;

use App\Models\Questions;
use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QuestionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '问卷';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Questions);

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('所属用户'));
        $grid->column('title', __('标题'));
        $grid->column('status', __('是否显示'))->using(Questions::STATUS_TEXT)->label(Questions::STATUS_LABEL);
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));
        
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
        $show = new Show(Questions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->user('用户信息',function ($user)
        {
            $user->setResource('/admin/users');

            $user->id();
            $user->name();
            $user->email();
        });
        $show->field('status', __('是否显示'))->using(Questions::STATUS_TEXT);
        $show->field('banner', __('广告图'))->image();
        $show->field('description', __('Description'));
        $show->field('submit_btn_text', __('提交按钮文案'));
        $show->field('redirect_text', __('跳转文案'));
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
        $form = new Form(new Questions);

        $form->select('user_id', __('所属用户'))->options(User::getKeyValueList());
        $form->switch('status', __('是否显示'));
        $form->image('banner', __('广告图'));
        $form->text('title', __('标题'));
        $form->textarea('description', __('描述'));
        $form->text('submit_btn_text', __('提交按钮文案'));
        $form->text('redirect_text', __('跳转文案'));


        return $form;
    }
}
