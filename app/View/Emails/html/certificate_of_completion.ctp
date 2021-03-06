<?php
  if (!isset($dialog)) {
    echo "<style type='text/css'>";
    include CSS . 'email_print.css';
    echo "</style>";
  }
 
  if (isset($dialog)) {
    echo $this->Html->css('email_print', null, array('inline' => false));
    echo "<div id='dialog-flash'>";
    echo $this->Session->flash();
    echo $this->Session->flash('email');
    echo __('You may want to print this for your records.');
    echo "</div>";
  }
  ?>
  <div id="email-print-wrapper">
  <h2>
    <?php echo __('Completion Certificate for %s', $title) ?>
  </h2>



  <p><span class="label"><?php echo __('Name') ?>:</span> <?php echo $name ?> </p>
  <p><span class="label"><?php echo __('Date') ?>:</span> <?php echo $date ?></p>
  <p><span class="label"><?php echo __('Time') ?>:</span> <?php echo $time ?></p>
  
  
  
    <?php foreach (array('tutorial' => $tutorial_grades, 'quiz' => $quiz_grades) as $type => $grades) { ?>
      <?php if (!empty($grades)) { ?>
      <h3><?php echo __('Your %s results', $type) ?></h3>
      <p><span class="label"><?php echo __('Score') ?>:</span>

      <?php echo __('%d out of %d', $grades['score'], $grades['total']) ?>

      (<?php echo round(($grades['score'] / $grades['total']) * 100, 2) ?>%)
      </p>
        <?php if ($grades['total'] > 0) { ?>
          <table>
            <thead>
              <tr>
                <th class="question-number">#</th>
                <th class="question-text"><?php echo __('Question') ?></th>
                <th class="question-eval"><?php echo __('Correct?') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $altrow = 0;
              foreach($grades as $order => $detail) {
                if (is_numeric($order)) {
                  $correct = __('No');
                  if ($detail['user_correct']) {
                    $correct = __('Yes');
                  }
                  $answer = $detail['user_answer'];
                  if (empty($detail['user_answer'])) {
                    $answer = __('nothing');
                  }
                  $question_number = $order + 1; 
                  $altrow_class = '';
                  if (($altrow % 2) == 1) {
                    $altrow_class = " class='altrow'";
                  } ?>
                  <tr <?php echo $altrow_class ?>>
                    <td class="question-number"><?php echo $question_number ?></td>
                    <td class="question-text"><dt><?php echo $detail['question'] ?></dt><dd><?php echo $detail['user_answer'] ?></td>
                    <td class="question-eval"><?php echo $correct ?></td>
                  </tr>
            <?php 
                  $altrow++;
                }
              }
            ?>
            </tbody>
          </table>
        <?php } ?>
      <?php } ?>
  <?php } ?>
  
  <?php if (count($free_responses) > 0): ?>
      <h3><?php echo __('Your free responses') ?></h3>
      <table>
        <thead>
          <tr>
            <th class="free-response question-text"><?php echo __('Prompt &amp; Answer') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($free_responses as $free_response): ?>
            <?php $prompt = array_keys($free_response) ?>
            <tr>
                <td class="question-text">
                  <dt><?php echo $prompt[0] ?></dt>
                  <dd>
                    <?php echo 
                      (!empty($free_response[$prompt[0]])) ? $free_response[$prompt[0]] : __('no answer given')
                    ?> 
                  </dd>
                </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  <?php endif ?>
      
      
  </div>

