<?php

namespace App\Admin\Controllers;

use Encore\Admin\Layout\Content;
use App\Models\QuestionResults;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Table;

class QuestionResultsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '问卷结果';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QuestionResults);

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('所属用户'));
        $grid->column('contact_name', __('联系人姓名'));
        $grid->column('contact_mobile', __('联系人电话'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));


        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            // 去掉编辑
            $actions->disableEdit();
        });

        $grid->exporter(new \App\Admin\Exporters\QuestionResultsExporter());

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
        // $show = new Show(QuestionResults::findOrFail($id));

        // $show->field('id', __('Id'));
        // $show->field('user_id', __('所属用户'));
        // $show->field('contact_name', __('联系人姓名'));
        // $show->field('contact_mobile', __('联系人电话'));
        // $show->field('content', __('内容'));
        // $show->field('created_at', __('创建时间'));
        // $show->field('updated_at', __('更新时间'));

        // return $show;
    }

    public function show($id, Content $content)
    {
        return $content->header('Post')
            ->description('详情')
            ->body(Admin::show(QuestionResults::findOrFail($id), function (Show $show) {

                $show->field('id', __('Id'));
                $show->field('contact_name', __('联系人姓名'));
                $show->field('contact_mobile', __('联系人电话'));
                //$show->field('content', __('内容'));
                $show->field('created_at', __('创建时间'));
                $show->field('updated_at', __('更新时间'));

                $show->panel()
                     ->tools(function ($tools) {
                        $tools->disableEdit();
                     });;

                

                $show->content('问卷信息')->unescape()->as(function ($content)
                {
                    $headers = ['问题', '答案'];
                    $list = collect($content)->pluck('answre','title');
                    $table = new Table($headers, $list->toArray());
                    return $table->render();
                });

                $show->user('用户信息',function ($user)
                {
                    $user->setResource('/admin/users');
        
                    $user->id();
                    $user->name();
                    $user->email();
                });
        }));
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
