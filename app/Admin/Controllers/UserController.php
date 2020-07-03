<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('openid', __('Openid'));
        $grid->column('session_key', __('Session key'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('nickname', __('Nickname'));
        $grid->column('sex', __('Sex'));
        $grid->column('tel', __('Tel'));
        $grid->column('status', __('Status'));
        $grid->column('token', __('Token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));

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
        $show->field('openid', __('Openid'));
        $show->field('session_key', __('Session key'));
        $show->field('avatar', __('Avatar'));
        $show->field('nickname', __('Nickname'));
        $show->field('sex', __('Sex'));
        $show->field('tel', __('Tel'));
        $show->field('status', __('Status'));
        $show->field('token', __('Token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('openid', __('Openid'));
        $form->text('session_key', __('Session key'));
        $form->image('avatar', __('Avatar'));
        $form->text('nickname', __('Nickname'));
        $form->switch('sex', __('Sex'))->default(1);
        $form->text('tel', __('Tel'));
        $form->switch('status', __('Status'))->default(1);
        $form->text('token', __('Token'));

        return $form;
    }
}
