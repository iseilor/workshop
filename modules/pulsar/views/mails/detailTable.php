
<table>
    <thead>
        <th>№</th>
        <th>ФИО</th>
        <th>Дата</th>
        <td>Здоровье</td>
        <td>Настроение</td>
        <td>Работоспособность</td>
    </thead>
    <tbody>
    <?php foreach ($data as $i=>$item): ?>
        <tr>
            <td><?=$i+1?></td>
            <td><?=$item->fio?></td>
            <td><?=(isset($item->pulsar->created_at))?$item->pulsar->created_at:''?></td>
            <td></td>
            <td></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>