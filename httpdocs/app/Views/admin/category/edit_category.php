<div class="row">
    <div class="col-lg-7 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= trans('update_category'); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('categories'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= trans('categories'); ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Category/editCategoryPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $category->id; ?>">
                <div class="box-body">
                    <?php $model = new \App\Models\CategoryModel();
                    foreach ($activeLanguages as $language):
                        $langCategory = $model->getCategory($category->id, $language->id); ?>
                        <div class="form-group">
                            <label><?= trans("category_name"); ?> (<?= esc($language->name); ?>)</label>
                            <input type="text" class="form-control" name="name_lang_<?= $language->id; ?>" placeholder="<?= trans("category_name"); ?>" value="<?= !empty($langCategory) ? esc($langCategory->name) : ''; ?>" maxlength="255" required>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label class="control-label"><?= trans("slug"); ?>
                            <small>(<?= trans("slug_exp"); ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug" value="<?= esc($category->slug); ?>" placeholder="<?= trans("slug"); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('title'); ?> (<?= trans('meta_tag'); ?>)</label>
                        <input type="text" class="form-control" name="title_meta_tag" placeholder="<?= trans('title'); ?> (<?= trans('meta_tag'); ?>)" value="<?= esc($category->title_meta_tag); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('description'); ?> (<?= trans('meta_tag'); ?>)</label>
                        <input type="text" class="form-control" name="description" placeholder="<?= trans('description'); ?> (<?= trans('meta_tag'); ?>)" value="<?= esc($category->description); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('keywords'); ?> (<?= trans('meta_tag'); ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= trans('keywords'); ?> (<?= trans('meta_tag'); ?>)" value="<?= esc($category->keywords); ?>">
                    </div>
                    <div class="form-group">
                        <label><?= trans('order'); ?></label>
                        <input type="number" class="form-control" name="category_order" placeholder="<?= trans('order'); ?>" value="<?= esc($category->category_order); ?>" min="1" max="99999" required>
                    </div>
                    <div class="form-group">
                        <label><?= trans('parent_category'); ?></label>
                        <div id="category_select_container">
                            <?php $parentArray = array();
                            if (!empty($category->parent_tree)) {
                                $parentArray = explode(',', $category->parent_tree);
                            }
                            array_push($parentArray, $category->id);
                            $level = 1;
                            foreach ($parentArray as $parentId):
                                $parentItem = $model->getCategory($parentId);
                                if (!empty($parentItem)):
                                    $subCategories = $model->getSubCategoriesByParentId($parentItem->parent_id);
                                    if (!empty($subCategories)): ?>
                                        <select name="category_id[]" class="form-control subcategory-select" data-level="<?= $level; ?>" onchange="getSubCategories(this.value,'<?= $level; ?>');">
                                            <option value=""><?= trans('none'); ?></option>
                                            <?php foreach ($subCategories as $subCategory):
                                                if ($subCategory->id != $category->id):?>
                                                    <option value="<?= $subCategory->id; ?>" <?= $subCategory->id == $parentItem->id ? 'selected' : ''; ?>><?= getCategoryName($subCategory); ?></option>
                                                <?php endif;
                                            endforeach; ?>
                                        </select>
                                    <?php endif;
                                endif;
                                $level++;
                            endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= trans("visibility"); ?></label>
                        <?= formRadio('visibility', 1, 0, trans("show"), trans("hide"), $category->visibility); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("show_on_main_menu"); ?></label>
                        <?= formRadio('show_on_main_menu', 1, 0, trans("yes"), trans("no"), $category->show_on_main_menu); ?>
                    </div>
                    <div class="form-group">
                        <label><?= trans("show_image_on_main_menu"); ?></label>
                        <?= formRadio('show_image_on_main_menu', 1, 0, trans("yes"), trans("no"), $category->show_image_on_main_menu); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= trans('image'); ?></label>
                        <?php if (!empty($category->image)): ?>
                            <div class="img-category display-block m-b-15">
                                <img src="<?= getCategoryImageUrl($category); ?>" alt="" style="height: 200px;">
                            </div>
                        <?php endif; ?>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?= trans('select_image'); ?>
                                <input type="file" id="Multifileupload" name="file" size="40" accept=".jpg, .jpeg, .webp, .png, .gif">
                            </a>
                            <?php if (!empty($category->image)): ?>
                                <a href="#" class="btn btn-sm btn-danger btn-delete-category-img" onclick="deleteCategoryImage('<?= $category->id; ?>');"><?= trans("delete"); ?></a>
                            <?php endif; ?>
                        </div>
                        <div id="MultidvPreview" class="image-preview"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= trans('save_changes'); ?> </button>
                </div>
            </form>
        </div>
    </div>
</div>