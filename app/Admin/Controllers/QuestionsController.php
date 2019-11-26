<?php

namespace App\Admin\Controllers;

use App\Models\Questions;
use App\Models\QuestionItems;
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
        $grid->column('no', __('编号'))->link(function(){
            return route('questionnaire',['no'=>$this->no]);
        });
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
        $show->field('banner', __('banner'))->image();
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
        $form->switch('status', __('是否显示'))->states([
            'on' => ['value'=>Questions::STATUS_SHOW, 'text'=>Questions::STATUS_TEXT[Questions::STATUS_SHOW], 'color' => Questions::STATUS_LABEL[Questions::STATUS_SHOW]],
            'off' => ['value'=>Questions::STATUS_HIDE, 'text'=>Questions::STATUS_TEXT[Questions::STATUS_HIDE], 'color' => Questions::STATUS_LABEL[Questions::STATUS_HIDE]],
        ]);
        $form->image('banner', __('banner'));
        $form->text('title', __('标题'));
        $form->textarea('description', __('描述'));
        $form->text('form_title', __('表单标题'))->default('');
        $form->text('bottom_title', __('底部标题'))->default('');
        $form->text('bottom_info', __('标题信息'))->default('');
        $form->text('submit_btn_text', __('提交按钮文案'))->default('提交');
        $form->text('redirect_text', __('跳转文案'))->default('提交成功');

        $form->divider();
        $form->hasMany('item', __('问题列表'), function (Form\NestedForm $form) {
            $form->text('title', __('标题'));
            $form->text('value', __('选项'))->help('多个选项按照英文逗号分隔');
            $form->switch('status', __('是否显示'))->states([
                'on' => ['value'=>QuestionItems::STATUS_SHOW, 'text'=>QuestionItems::STATUS_TEXT[QuestionItems::STATUS_SHOW], 'color' => QuestionItems::STATUS_LABEL[QuestionItems::STATUS_SHOW]],
                'off' => ['value'=>QuestionItems::STATUS_HIDE, 'text'=>QuestionItems::STATUS_TEXT[QuestionItems::STATUS_HIDE], 'color' => QuestionItems::STATUS_LABEL[QuestionItems::STATUS_HIDE]],
            ]);
        });

        return $form;
    }
}
