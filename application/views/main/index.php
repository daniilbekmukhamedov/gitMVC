                <div class="content-wrap" id="page-top">
                    <div class="content">
                        <div class="page-top">
                            <h1> News</h1>
                            <div class="unline"></div>
                        </div>
                    </div>
                </div>

                <?php if (empty($list)): ?>
                <p>List is empty</p>
                <?php else: ?>
                <?php foreach ($list as $key => $val): ?>
                <div class="content-wrap">
                    <div class="content">
                        <div class="index-news">
                            <div class="index-news-text">
                                <a href="post/<?= $val['id']; ?>">
                                    <h2 class="newsItemName">
                                        <?= htmlspecialchars($val['title'], ENT_QUOTES);?>
                                    </h2>
                                </a>
                                <span class="date"><?= date('d.m.Y', htmlspecialchars($val['date'], ENT_QUOTES));?></span>

                                <h3><?= htmlspecialchars($val['description'], ENT_QUOTES);?></h3>
                            </div>
                            <div class="index-news-photo">
                            <?php if (file_exists('public/materials/'.$val['id'].'.jpg')): ?>
                                <img src="/public/materials/<?= htmlspecialchars($val['id'], ENT_QUOTES);?>.jpg" width="100%" height="100%"/>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="unline"></div>
                        <div class="adminControls" <?php if (!isset($_SESSION['admin'])) echo 'style="height:0px !important;"' ?>>
                        <?php if (isset($_SESSION['admin'])):?>
                            <div class="adminControlsItem"><a href="/admin/edit/<?= $val['id'];?>"><span>Edit</span></a></div>
                            <div class="adminControlsItem"><a href="/admin/delete/<?= $val['id'];?>"><span>Delete</span></a></div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>

                <div class="content-wrap" id="pagin">
                    <div class="content">
                            <?= $pagination; ?>
                    </div>
                </div>