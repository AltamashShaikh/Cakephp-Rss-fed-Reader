<br>
<div class="row">
    <div class="col-md-8">
        <h2>Rss Feed from: <a href="<?php echo $feed_url; ?>"><?php echo $feed_url; ?></a></h2>
    </div>
    <div class="col-md-4">
        <span class="pull-right">
            <p id="current_time"></p>
            <p>Time Spent: <span id="time_spent"></span></p>
        </span>
    </div>
</div>
<br>
<?php
if (isset($news) && !is_null($news)) {
    foreach ($news as $key => $newsItem) {
        ?>
        <div id="feed_<?php echo $key ?>">
            <div class="col-md-12">
                <div class="span12">
                    <div class="row">
                        <div class="span8">
                            <h4><strong><a href="<?php echo $newsItem->link; ?>"><?php echo $newsItem->title; ?></a></strong></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span2">
                            <div class="thumbnails">
                                <?php echo $newsItem->description; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span8">
                            <p></p>
                            <p>
                                <i class="icon-calendar"></i> <?php echo $this->Time->nice($newsItem->pubDate); ?>
                                <span class="pull-right"><button type="button" class="btn btn-sm btn-danger hide-feed" data-id="<?php echo $key ?>">Hide</button></span>
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <?php
    }
} else {
    echo $this->Html->nestedList(
            array('<p>News unavailable.</p>'), array('class' => 'news')
    );
}
?>
<script>
    var start;
    $(window).on('ready', function () {
        start = (new Date()).getTime();
        getdate();
    })


    $('.hide-feed').on('click', function () {
        $('#feed_' + $(this).data('id')).hide();
    });

    function getdate() {
        end = (new Date()).getTime();
        var ms = end - start;
        min = (ms / 1000 / 60) << 0,
                sec = parseInt((ms / 1000) % 60);
        var d = new Date();
        var n = d.toISOString();
        $('#current_time').html(n);
        $('#time_spent').html(min + ':' + (sec < 10 ? "0" + sec : sec));
        setTimeout(function () {
            getdate()
        }, 1000);
    }
</script>