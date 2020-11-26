<?php
namespace Shengyouai\Sub\UserCenter;

use Illuminate\Support\ServiceProvider;

class UserCenterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 配置文件迁移
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/../config/u_center.php' => config_path('u_center.php')
            ], 'config');

            // 数据库迁移脚本
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }


        // 控制器，路由迁移
        $this->loadRoutesFrom(__DIR__ . '/../routes/u_routes.php');

        if ($this->app->runningInConsole()) {
            $this->commands([]);
        }
    }

    /**
     * 注册绑定
     */
    public function register()
    {

        // 合并配置
        $this->mergeConfigFrom(
            __DIR__ . '/../config/u_center.php',
            'u_center'
        );
    }
}