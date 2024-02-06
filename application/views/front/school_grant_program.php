<!-- <section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <?= @$breadcrumbs ? $breadcrumbs : '' ?>
        </div>
    </div>
</section> -->
<section id="content">
    <div class="container">
        <div class="row">           
            <div class="col-md-9 col-sm-12">
                <h1 class="article-title"><?= $article->name ?></h1>
                <?php if (!empty($article)) : ?>                    
                    <div class="mt-4 p-5 bg-light rounded"  data-aos="fade-up" data-aos-delay="100">
                        <h5 class="fw-bold">Նպատակ</h5>
                        <p class="lead"><?= $article->purpose; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold">Շահառու խմբեր</h5>
                        <p class="lead"><?= $article->interest_groups; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold">Իրականացման վայր/եր</h5>
                        <p class="lead"><?= $article->location; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold">Իրականացնող դպրոց և կամ կառույց/ներ</h5>
                        <p class="lead"><?= $article->structure; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold">աջողության պատմություններ</h5>
                        <p class="lead"><?= $article->quotes; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold">Գործողություններ և ակնկալվող արդյունքներ, վիճակագրություն (առանձնացված դաշտեր ըստ սեռի, տարիքի, բնակավայրի, այլ նկարագրիչների)</h5>
                        <p class="lead"><?= $article->results; ?></p>
                        <hr class="my-4">
                        <h5 class="fw-bold">Ժամանակահատված</h5>
                        <p class="lead"><?= $article->time; ?></p>
                    </div>
                <?php else : ?>
                    <h4 class="text-center text-danger fs-6"><?= $not_items; ?></h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</section>