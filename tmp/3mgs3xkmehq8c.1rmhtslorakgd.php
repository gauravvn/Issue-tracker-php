--- ---
<?= ($site['name'])."
" ?>
Issue #<?= ($issue['id']) ?> <?= ($issue['name']) ?> created

Author: <?= ($issue['author_name'])."
" ?>
Assigned to: <?= ($issue['owner_name'])."
" ?>
Priority: <?= ($issue['priority_name'])."
" ?>
Status: <?= ($issue['status_name'])."
" ?>
Planned Hours: <?= ($issue['hours_total'] ?: 'None')."
" ?>
Due Date: <?= ($issue['due_date'] ? date("D, M j, Y", strtotime($issue['due_date'])) : 'None')."
" ?>

Description:
<?= ($issue['description'])."
" ?>

View issue: <?= ($site['url']) ?>issues/<?= ($issue['id'])."
" ?>

<?= (date("D, M j, Y \\a\\t g:ia", $this->utc2local(strtotime($issue['created_date']))))."
" ?>
