<?php
/////////postgres
include 'db.php';
////////////////////

 $result = $db->query('select id, title, link, parent_id, f_order from page');
while ($row = $result->fetchArray()) {
    $id =  $row['id'];
    $parent = $row['parent_id'];
    $text = $row['title'];
    $link = $row['link'];
    $order = $row['f_order'];
    $all[$parent][] = array('id' => $id,
                            'text' => $text,
                            'link' => $link,
                            'parent' => $parent,
                            'order'=>$order);

}
                function Recurs(&$rs, $parent)
                {
                    $out = array();
                    if (!isset($rs[$parent]))
                    {
                        return $out;
                    }
                    foreach($rs[$parent] as $row)
                    {
                        $chidls = Recurs($rs, $row['id']);
                        if ($chidls)
                        {
                            if ($row['id_parent'] == 0)
                            {
                                $row['toggle'] = false;
                                $row['hidden'] = true;
                                $row['expanded'] = true;
                                $row['children'] = $chidls;
                               // $row['text'] = '';
                            }
                            else if (isset($row['exp']))
                            {
                                $row['expanded'] = $row['exp'];
                                $row['children'] = $chidls;
                            }
                            else
                            {
                                $row['expanded'] = false;
                                $row['children'] = $chidls;
                            }
                        }
                        $out[] = $row;
                    };
                    return $out;
                };      
exit(json_encode(Recurs($all, 0)));
pg_close($con);
