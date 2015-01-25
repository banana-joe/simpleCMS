<?php
if (isset($_GET['function']))
{
    switch ($_GET['function'])
    {
        case 'list':
        $sql = "SELECT * FROM articles ORDER BY date DESC";
        $res = mysql_query($sql) or die(mysql_error());
        
        if (mysql_num_rows($res))
        {
            while ($row = mysql_fetch_array($res))
            {
                $article[] = $row;
            }
            
            $tpl = new raintpl();
            $tpl->assign("article", $article);
            $tpl->draw('articles.list');
        }
        else
        {
            $tpl = new raintpl();
            $tpl->assign('error', 'No articles in database.');
            $tpl->draw('error');
        }
        break;
        
        case 'show':
        if (isset($_GET['id']))
        {
            $id = mysql_real_escape_string($_GET['id']);
            $sql = "SELECT * FROM articles WHERE id = '$id'";
            $res = mysql_query($sql) or die(mysql_error());
            
            if (mysql_num_rows($res))
            {
                while ($article = mysql_fetch_array($res))
                {
                    $tpl = new raintpl();
					$tpl->assign('id', $article['id']);
					$tpl->assign('title', $article['title']);
					$tpl->assign('content', $article['content']);
					$tpl->assign('date', $article['date']);
					$tpl->assign('thumb', $article['thumb']);
					$tpl->assign('author', $article['author']);
					$tpl->draw('articles.show');
                }
            }
            else
            {
                $tpl = new raintpl();
                $tpl->assign('error', 'There is no article with this id.');
                $tpl->draw('error');
            }
        }
        break;
    }
}
?>
