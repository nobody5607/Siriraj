<?php

echo \kartik\tree\TreeViewInput::widget([
    'name' => 'section_id',
    'value' => 'true', // preselected values
    'query' => backend\modules\content_management\models\TreeSections::find()->addOrderBy('parent_id, id'), //\tests\models\Tree::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => 'Store'],
    'rootOptions' => ['label' => '<i class="fa fa-tree text-success"></i>'],
    'fontAwesome' => true,
    'asDropdown' => true,
    'multiple' => false,
    'options' => ['disabled' => false, 'class'=>'test1']
]);
?>