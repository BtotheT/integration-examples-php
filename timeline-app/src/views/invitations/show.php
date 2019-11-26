<?php

/**
 * 
 * @var array $invitation
 */

include __DIR__.'/../_partials/header.php';
?>

<div class="row">
    <div class="column">
        <table>
            <tbody>
                <?php foreach ($invitation as $key=>$value) {?>
                <tr>
                    <td><?=$key;?></td>
                    <td><?=htmlspecialchars($value);?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
            <a id='invitation-update' class="button" href="/invitations/update.php?id=<?=$invitation['id'];?>">Update</a>
            <a id='invitation-delete' class="button" href="/invitations/delete.php?id=<?=$invitation['id'];?>">Delete</a>
            <a id='invitation-delete' class="button" href="/invitations/list.php">List</a>
        </div>
    </div>
</div>

<?php include __DIR__.'/../_partials/footer.php' ?>
