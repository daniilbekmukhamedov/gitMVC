                <div class="content-wrap" id="page-top">
                    <div class="content">
                        <div class="page-top">
                            <h1>Edit News</h1>
                            <div class="unline"></div>
                        </div>
                    </div>
                </div>

                <div class="content-wrap">
                    <div class="content">
                        <div class="page-content">
                            <form method="POST" action="/admin/edit/<?= $data['id']; ?>" class="newsform">

                                <p><span>Title:</span></p>
                                <input type="text" name="title" value="<?= htmlspecialchars($data['title'], ENT_QUOTES); ?>" placeholder="" />
                                
                                <p><span>Description:</span></p>
                                <textarea name="description" placeholder=""><?= htmlspecialchars($data['description'], ENT_QUOTES); ?></textarea>

                                <input type="submit" value="Save changes" />
                                
                            </form>
                        </div>
                    </div>
                </div>