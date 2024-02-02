<section class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <?= @$breadcrumbs ? $breadcrumbs : '' ?>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-12 text-left mainnews" data-aos="fade-up" data-aos-delay="100">
        <?php if (!empty($article)) : ?>
          <h1 class="article-title"><?= $article->name ?></h1>
          <div class="datetab row">
            <div class="col-sm-3">
                <small><?= my_date(date($article->date), $lang) . '&nbsp;&nbsp;|&nbsp;&nbsp;<i class="bx bx-show" style="font-size: 22px;vertical-align: sub;"></i> ' . $article->votes; ?></small>
            </div>
            <?php if (!empty($article->tag_name)) : ?>
              <div class="col-sm-9 article-tags ">
                <?php foreach ($article->tag_name as $key => $item) : ?>
                  <a href="<?= base_url('tags/') . $key; ?>"><?= '#' . $item; ?></a>
                <?php endforeach ?>
              </div>
            <?php endif; ?>
          </div>
          <?php if ($article->img && $this->uri->segment(3) <> 25) : ?>
            <a href="<?= cdn($article->img, 700, 449); ?>" data-caption="<?= $article->name ?>" data-fancybox="images">
                <img class="lazyload mb-4" data-src="<?= cdn($article->img, 530, 340); ?>" alt="<?= $article->name ?>" onerror="this.style.display='none'" />
            </a>           
          <?php endif; ?>
          <p><?= $article->text ?></p>
          <p><?= $article->longtext ?></p>
          <?php if(@$article->files):?>
            <div class="tg-tagsshare">
                <ul class='files_cont row'>
                    <?php foreach(json_decode($article->files) as $file): if(!$file->path || !$file->extension) continue; ?>													
                        <li class="files_cont_item col-sm-6">
                            <a href="<?php echo base_url("uploads/documents/".$file->path)?>" class='' target='_blank'>
                                <i class="bi <?php echo ( $file->extension == '.xlsx' || $file->extension =='.xls' || $file->extension =='.xml')?'bi-filetype-xml text-success':(($file->extension == '.pdf')?'bi-file-pdf text-danger': 'bi-file-earmark-text text-muted') ?>" aria-hidden="true"></i>
                                <span><?php echo $file->path?></span>
                            </a>
                        </li>
                    <?php endforeach;?>		
                </ul>
            </div>
          <?php endif?>
          <div class="td-block-row td-post-next-prev">
            <div class="td-block-span6 td-post-prev-post">
              <?php if (!empty($prev)) : ?>
                <div class="td-post-next-prev-content">
                  <div class="titler"><span><?= $this->lang->line('prev_article') ?></span></div>
                  <a href="<?= site_url($lang . '/article?'.$prev->name. '&i=' . $prev_id); ?>"><?= $prev->name ?></a>
                </div>
              <?php endif; ?>
            </div>
            <div class="td-block-span6 td-post-next-post">
              <?php if (!empty($next)) : ?>
                <div class="td-post-next-prev-content">
                  <div class="titler"><span><?= $this->lang->line('next_article') ?></span></div>
                  <a href="<?= site_url($lang . '/article?'.$next->name. '&i=' . $next_id); ?>"><?= $next->name ?></a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php else : ?>
          <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
        <?php endif; ?>
      </div>
      <div class="col-md-3 col-sm-12" data-aos="fade-up" data-aos-delay="100">
        <?php if (!empty($topic)) : ?>
          <h2 class="article-title"><?= $this->lang->line('topic') ?></h2>
          <?php foreach ($topic as $key => $item) : ?>
            <a href="<?= base_url('article?'.$item->name. '&i=' . $item->id); ?>" title="<?= $item->name ?>">
              <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-4">
                    <img class="img-fluid rounded-start lazyload h-100 w-100 object-fit-cover" data-src="<?= cdn($item->img, 100, 100); ?>" alt="<?= $item->name ?>" onerror="this.src = '<?php echo base_url('documents/img/default.png'); ?>'">
                  </div>
                  <div class="col-8">
                    <div class="card-body">
                      <p class="card-text text-dark word-break-all"><?= character_limiter($item->name, 32) ?></p>
                      <p class="card-text"><small class="text-muted"><?= my_date(date($item->date), $lang); ?></small></p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          <?php endforeach ?>
      </div>
    <?php endif; ?>
    </div>
  </div>
  </div>
</section>