var folder = <?php $out = array();
foreach (glob('assets/music/*') as $albumame) {
    $p = pathinfo($albumname);
    $out[] = $p['albumname'];
}
echo json_encode($out); ?>;
