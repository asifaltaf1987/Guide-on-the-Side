
<?php
  echo $this->Form->create('Definition');
  echo $this->Form->input('link text',
    array(
		'label' => __('Link text'),
      'between' => '<br />',
      'after' => '<br />' . __('This is required.')
    )
  );

  echo $this->QuickhelpTinyMce->editor('QuickHelp_simple');

  echo $this->Form->input('definition', array('type' => 'textarea', 'class' => 'mceQuickHelpSimple'));

  echo $this->element('tinymce_dialog_buttons');

  echo $this->Form->end();

