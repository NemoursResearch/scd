<style>
.json-file .post .meta-info { margin: 1em 0; }
.post { margin-bottom: 2em; }
.json-file h2 {
    background-color: #4FA4B4; padding: .5em; color: white !important; cursor: pointer;
}
.json-file h2:hover { color: #2c5e68 !important; }
.list { display: none; }
.icon-angle-up { display: none; }
.by-year.open .icon-angle-up { display: inline-block; }
.by-year.open .icon-angle-down { display: none; }
.by-year.open .list { display: block; }
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.json-file h2').click(function() {
        console.log('here!');
        var parent = $(this).parents('.by-year')
        var isOpen = parent.hasClass('open')
        if(isOpen) {
            return parent.removeClass('open');
        }
        parent.addClass('open');
    })
});
</script>
<div class="json-file">
    <?php foreach ($years as $year=>$items) : ?>
        <div class="by-year">
            <h2 id="year-<?php echo $year; ?>">
                Year <?php echo $year; ?>
                <span class="pull-right">
                    <span class="icon-angle-down"></span>
                    <span class="icon-angle-up"></span>
                </span>
            </h2>
            <div class="list">
                <?php foreach ($items as $item) : ?>
                    <div class="post">
                        <div class="post-content">
                            <p><?php echo nl2br($item->citation) ?></p>
                        </div>
                        <div class="meta-info">
                            <div class="vcard">
                                <span>Investigator: <span><?php echo $item->investigator ?></span></span>
                                <span class="sep">|</span>
                                <span>Date: <?php echo $item->date ?></span>
                                <?php if ($item->type) : ?>
                                    <span class="sep">|</span>
                                    <span>Type: <?php echo $item->type ?></span>
                                <?php endif; ?>
                                <?php if ($item->pmcid) : ?>
                                    <span class="sep">|</span>
                                    <span>
                                        <a target="_blank" href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?php echo $item->pmcid ?>">
                                            PubMED <i class="icon-link"></i>
                                        </a>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
