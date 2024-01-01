<?php
namespace LaravelViews\Macros;

use Livewire\Features\SupportTesting\Testable;

class LaravelViewsTestMacros
{
    public function register()
    {
        Testable::macro('assertShowSuccessAlert', function ($message = null) {
            $this->assertDispatched('notify', [
                'message' => $message ?? __('Action was executed successfully'),
                'type' => 'success'
            ]);

            return $this;
        });

        Testable::macro('assertShowErrorAlert', function ($message = null) {
            $this->assertDispatched('notify', [
                'message' => $message ?? __('There was an error executing this action'),
                'type' => 'danger'
            ]);

            return $this;
        });

        Testable::macro('executeAction', function ($actionClass, $model = null) {
            $action = new $actionClass;
            $id = $model ? (is_numeric($model) ? $model : $model->getKey()) : null;
            $this->call('executeAction', $action->getId(), $id);

            return $this;
        });

        Testable::macro('confirmAction', function ($actionClass, $model = null) {
            $action = new $actionClass;
            $id = $model ? is_numeric($model) ? $model : $model->getKey() : null;
            $this->call('confirmAndExecuteAction', $action->getId(), $id);

            return $this;
        });

        Testable::macro('executeBulkAction', function ($actionClass) {
            $action = new $actionClass;
            $this->call('executeBulkAction', $action->getid());

            return $this;
        });

        Testable::macro('selectAll', function () {
            $this->set('allSelected', true);

            return $this;
        });
    }
}
