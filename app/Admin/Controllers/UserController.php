<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('Id'));
        $grid->column('name', __('用户名'));
        $grid->column('email', __('邮箱'));
        //$grid->column('email_verified_at', __('Email verified at'));
        //$grid->column('password', __('Password'));
        //$grid->column('remember_token', __('Remember token'));
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('用户名'));
        $show->field('email', __('邮箱'));
        //$show->field('email_verified_at', __('Email verified at'));
        //$show->field('password', __('Password'));
       // $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new User);

        $form->text('name', __('用户名'))->rules('required|min:2|max:32|unique:users,name,{{id}}', [
            'unique' => '用户名重复',
            'required' => '用户名必填',
            'min'   => '用户名长度不能小于2',
            'max'   => '用户名长度不能超过32',
        ]);
        $form->email('email', __('邮箱'))->rules('required|min:5|max:64|email|unique:users,email,{{id}}', [
            'unique' => '邮箱重复',
            'required' => '邮箱必填',
            'email' => '邮箱格式错误',
            'min'   => '邮箱长度不能小于5',
            'max'   => '邮箱长度不能超过64',
        ]);
        //$form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('密码'))->creationRules('required|min:6|max:16', [
            'required' => '密码必填',
            'min'   => '密码长度不能小于6',
            'max'   => '密码长度不能超过16',
        ])->updateRules('sometimes|nullable|min:6|max:16',[
            'min'   => '密码长度不能小于6',
            'max'   => '密码长度不能超过16',
        ]);
        
        //$form->text('remember_token', __('Remember token'));

        $form->saving(function (Form $form) {
            $password = $form->password;

            if(!empty($password)){
                $form->password = Hash::make($password);
            }else{
                $form->password = $form->model()->password;
            }
        });

        return $form;
    }
}
