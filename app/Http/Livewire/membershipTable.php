<?php

namespace App\Http\Livewire;
use App\Models\item;
use App\Models\membership;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\Rule;

final class membershipTable extends PowerGridComponent
{
    use ActionButton;

    //Messages informing success/error data is updated.
    public bool $showUpdateMessages = true;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): void
    {
        $this->showCheckBox()
            ->showPerPage()
            ->showSearchInput()
            ->showExportOption('download', ['excel', 'csv']);
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return  \Illuminate\Database\Eloquent\Builder<\App\Models\membership>|null
    */
    public function datasource(): ?Builder
    {
        return membership::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('gvBrowseCode')
            ->addColumn('gvBrowseCompanyName')
            ->addColumn('gvBrowseAttention')
            ->addColumn('gvBrowseUDF_TEMPATLAHIR')
            ->addColumn('gvBrowseUDF_ICNO')
            ->addColumn('gvBrowsePhone1')
            ->addColumn('gvBrowseAddress1')
            ->addColumn('gvBrowseArea')
            ->addColumn('gvBrowseUDF_DOB')
            ->addColumn('gvBrowseUDF_NOAHLISKMC')
            ->addColumn('gvBrowseUDF_TARIKHMEMOHON')
            ->addColumn('gvBrowseUDF_PEKERJAAN')
            ->addColumn('gvBrowseUDF_JANTINA')
            ->addColumn('item_id',function(membership $model){
                return (!empty($model->item) ? $model->item->title   : 'Null')."-".
                (!empty($model->item) ? $model->item->year   : 'Null')
                ;
            })
            ->addColumn('created_at_formatted', function(membership $model) { 
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function(membership $model) { 
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::add()
                ->title('ID')
                ->field('id')
                ->makeInputRange(),

            Column::add()
                ->title('CODE')
                ->field('gvBrowseCode')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('Company Name')
                ->field('gvBrowseCompanyName')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('Keluarga')
                ->field('gvBrowseAttention')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('TEMPAT LAHIR')
                ->field('gvBrowseUDF_TEMPATLAHIR')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('IC NO')
                ->field('gvBrowseUDF_ICNO')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('PHONE 1')
                ->field('gvBrowsePhone1')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('ADDRESS 1')
                ->field('gvBrowseAddress1')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('AREA')
                ->field('gvBrowseArea')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('DOB')
                ->field('gvBrowseUDF_DOB')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('NO AHLI SKMC')
                ->field('gvBrowseUDF_NOAHLISKMC')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('TARIKH MEMOHON')
                ->field('gvBrowseUDF_TARIKHMEMOHON')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('PEKERJAAN')
                ->field('gvBrowseUDF_PEKERJAAN')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('JANTINA')
                ->field('gvBrowseUDF_JANTINA')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title('Last Payment')
                ->field('item_id')
                ->makeInputRange(),

            Column::add()
                ->title('CREATED AT')
                ->field('created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('created_at'),

            Column::add()
                ->title('UPDATED AT')
                ->field('updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('updated_at'),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid membership Action Buttons.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
     */

    
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption('Edit')
               ->class('btn btn-info cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('members.edit', ['id' => 'id']),

           Button::add('destroy')
               ->caption('Delete')
               ->class('btn btn-danger cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('members.destroy', ['id' => 'id'])
               ->method('delete')
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid membership Action Rules.
     *
     * @return array<int, \PowerComponents\LivewirePowerGrid\Rules\RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [
           
           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($membership) => $membership->id === 1)
                ->hide(),
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable the method below to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

     /**
     * PowerGrid membership Update.
     *
     * @param array<string,string> $data
     */

    /*
    public function update(array $data ): bool
    {
       try {
           $updated = membership::query()->findOrFail($data['id'])
                ->update([
                    $data['field'] => $data['value'],
                ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
    */
}
