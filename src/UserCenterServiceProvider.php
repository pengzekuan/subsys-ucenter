<?php
namespace Shengyouai\Sub\UserCenter;

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
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

            $this->appendMigrationTimestamps();

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

    private function appendMigrationTimestamps()
    {
        $fs = new Filesystem();

        $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations';

        $files = $fs->files($path);
        $regex = '/^[0-9]{4}_([0-9]{1,2})_([0-9]{1,2})_[0-9]{6}/';
        $timestamps = Carbon::now()->format('Y_m_d_His');
        foreach ($files as $file) {
            if ($file->isFile()) {
                $fileName = $file->getFilename();
                $realPath = $path . DIRECTORY_SEPARATOR;
                if (!preg_match($regex, $fileName)) {
                    $fs->move($realPath . $fileName, $realPath . $timestamps . '_' . $fileName);
                }
            }
        }
    }
}