                <div class="content-wrap" id="page-top">
                    <div class="content">
                        <div class="page-top">
                            <h1>Post</h1>
                            <div class="unline"></div>
                        </div>
                    </div>
                </div>

                <div class="content-wrap">
                    <div class="content">
                        <div class="page-content">
                            <div class="post">
                                <div class="post-text">
                                    <h2><?= htmlspecialchars($data['title'], ENT_QUOTES);?></h2>
                                    <span class="date"><?= date('d.m.Y', htmlspecialchars($data['date'], ENT_QUOTES));?></span>

                                    <h3><?= htmlspecialchars($data['description'], ENT_QUOTES);?></h3>
                                </div>
                                <div class="post-photo">
                                    <?php if (file_exists('public/materials/'.$data['id'].'.jpg')): ?>
                                    <img src="/public/materials/<?= htmlspecialchars($data['id'], ENT_QUOTES);?>.jpg" width="100%" height="100%"/>
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
                </div>