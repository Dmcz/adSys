<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Questions;
use \App\Models\QuestionResults;
use Illuminate\Support\Facades\Auth;
use Encore\Admin\Layout\Content;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Show;

class QuestionResultsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    public function index()
    {
        return view('QuestionResults.index', [
            'gird' => $this->grid()->render()
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();

        $content = Admin::show(QuestionResults::where('id', '=', $user->id)->findOrFail($id), function (Show $show) {
            $show->field('id', __('Id'));
            $show->field('contact_name', __('联系人姓名'));
            $show->field('contact_mobile', __('联系人电话'));
            //$show->field('content', __('内容'));
            $show->field('created_at', __('创建时间'));
            $show->field('updated_at', __('更新时间'));

            $show->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableDelete();
                });;

            
            $show->content('问卷信息')->unescape()->as(function ($content)
            {
                $headers = ['问题', '答案'];
                $list = collect($content)->pluck('answre','title');
                $table = new Table($headers, $list->toArray());
                return $table->render();
            });
        });

        return view('QuestionResults.index', [
            'gird' => $content
        ]);
    }


     /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $user = Auth::user();

        $grid = new Grid(new QuestionResults);

        $grid->model()->where('id', '=', $user->id)->orderBy('id','desc');

        $grid->column('id', __('Id'));
        $grid->column('contact_name', __('联系人姓名'));
        $grid->column('contact_mobile', __('联系人电话'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));


        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            // 去掉编辑
            $actions->disableEdit();
            $actions->disableDelete();
        });

        $grid->exporter(new \App\Admin\Exporters\QuestionResultsExporter());

        return $grid;
    }
    
}
