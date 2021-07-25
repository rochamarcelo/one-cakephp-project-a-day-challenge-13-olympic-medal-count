<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country[] $countries
 */
?>
<?php
$this->assign('title', __('Olympics Medal Standings'));
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col"><?= __('Country')?></th>
        <th scope="col"><?= $this->Html->image('medal-gold-svgrepo-com.svg', [
            'alt' => __('Gold'),
            'style' => 'height: 24px',
        ])?></th>
        <th scope="col"><?= $this->Html->image('medal-silver-svgrepo-com.svg', [
            'alt' => __('Silver'),
            'style' => 'height: 24px',
        ])?></th>
        <th scope="col"><?= $this->Html->image('bronze-medal-svgrepo-com.svg', [
            'alt' => __('Silver'),
            'style' => 'height: 24px',
        ])?></th>
        <th scope="col"><?= __('Total')?></th>
    </tr>
    </thead>
    <tbody>

<?php foreach ($countries as $country): ?>
<tr>
    <td><?= h($country->name) ?></td>
    <td><?= $this->Number->format($country->gold_medal_count) ?></td>
    <td><?= $this->Number->format($country->silver_medal_count) ?></td>
    <td><?= $this->Number->format($country->bronze_medal_count) ?></td>
    <td><?= $this->Number->format($country->medal_count) ?></td>
</tr>
<?php endforeach; ?>
    </tbody>
</table>
