<?php

/* @var $action backend\controllers\UsersController (actionModalLog) название действия с пользователем */
/* @var $username backend\controllers\UsersController (actionModalLog) username пользователя */
/* @var $user_id backend\controllers\UsersController (actionModalLog) id пользователя */
/* @var $logs backend\controllers\UsersController (actionModalLog) действия с пользователем */

?>

<div class="modal-content">
    <div class="modal-header m-0">
        <h5 class="modal-title text-center text-danger mt-0"
            id="modalLog">Лог пользователя: <?= $username.' (id='.$user_id.')' ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body mr-2 ml-2 p-0">
        <table class="table table-sm m-2">
            <?php foreach ($logs as $log){?>
                <tr>
                    <td>Пользователь <?= $log['username'] ?> внёс изменения в таблицу <?= $log['table'] ?> c причиной "<?= $log['comment'] ?>" в <?= date('d.m.Y H:m:s',strtotime($log['created_at'])) ?> (<?= $log['created_ip'] ?>)</td>
                </tr>
            <?php } ?>
        </table>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
    </div>
</div><!-- /.modal-content -->
