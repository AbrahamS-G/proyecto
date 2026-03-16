<?php
if($data['url'] !== null && !isset($_SESSION['url'])){
    echo "url corta: ".$data['url']['UrlCorta'];
    $_SESSION['url'] = $data['url']['UrlLarga'];
    ?>
    <script>
        window.location.href = "/proyecto/url";
    </script>
    <?php
}else{
    if(isset($_SESSION['url'])){
        $url = $_SESSION['url'];
        unset($_SESSION['url']);
        ?>
        <script>
            window.location.href = "<?=$url?>";
        </script>
        <?php
    }else{
        echo "url no encontrada";
    }
}
?>