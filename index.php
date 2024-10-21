<?php
get_header();

global $post;

$post_id = get_the_ID();
global $all_categories;
$terms = wp_get_post_terms($post_id, 'real_type');
if (!empty($terms) && !is_wp_error($terms)) {
    $category_names = array();
    foreach ($terms as $term) {
        $category_names[] = $term->name;
    }
    $all_categories = implode(', ', $category_names);
}
?>

<main>
    <style>
    table.table-content {
        text-align: left;
    }

    table.table-content td,
    table.table-content th {
        border: 1px solid #000;
    }

    table.table-content th,
    table.table-content td.key,
    table.table-content td.value {
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }

    table.table-content th {
        width: 100%;
        border-top-width: 1px;
        border-left-width: 1px;
        border-right-width: 1px;
        text-transform: none;
        padding: 1rem;
        line-height: 100%;
    }

    table.table-content th p {
        margin-bottom: 0;
    }

    table.table-content td.key {
        width: 3rem;
        border-top-width: 0;
        border-left-width: 1px;
        border-right-width: 1px;
    }

    table.table-content td.value {
        border-top-width: 0;
        border-left-width: 0;
        border-right-width: 1px;
    }

    table.table-content table {
        border-collapse: collapse;
        width: 100%;
    }

    table.table-content strong {
        font-weight: bold;
        line-height: 100%;
        color: #9e1f63;
    }

    .single-real-estate .bds-gallery-thumb {
        left: 0;
    }

    @media (min-width:768px) {
        .tab_3_content.shrink {
            max-height: 800px;
            overflow-y: hidden;
        }

        .button-view {
            cursor: pointer;
            user-select: none;
        }
    }
    </style>
    <script>
    jQuery(document).ready(function($) {
        $('#save-favorite').on('click', function() {
            var postId = <?php echo get_the_ID(); ?>;
            var favorites = getCookie('favorites') || [];

            if (!Array.isArray(favorites)) {
                favorites = [];
            }

            if (favorites.indexOf(postId) === -1) {
                favorites.push(postId);
                setCookie('favorites', favorites.join(','), 30);
                alert('Bài viết đã được lưu vào danh sách yêu thích.');
            } else {
                alert('Bài viết đã tồn tại trong danh sách yêu thích.');
            }
        });
        if ($('.tab_3_content').height() <= 800) {
            $('.button-view').css("display", 'none');
        } else {
            $('.tab_3_content').addClass("shrink")
        }
        // click button xem thêm trên pc
        $('.button-view').on('click', function() {
            $('.tab_3_content').toggleClass("shrink");
            // 				console.log({element: $(this)});
            if ($('.tab_3_content').hasClass('shrink')) {
                $(this)?. [0]?.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                    inline: "nearest"
                });
            }
        })

        // Hàm lấy cookie
        function getCookie(name) {
            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");
            if (parts.length === 2) return parts.pop().split(";").shift().split(',');
        }

        // Hàm thiết lập cookie
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }
    });
    </script>
    <section class="bds-main">
        <div class="row">
            <div class="col bds-top">
                <div class="row align-middle">
                    <div class="col large-8">
                        <div class="breadcrumbs">
                            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                        </div>
                        <?php if ($all_categories == "Văn phòng trọn gói") { ?>
                        <h1><?php the_title(); ?> <span><?php echo $all_categories; ?></span></h1>
                        <?php } else { ?>
                        <h1><?php the_title(); ?></h1>
                        <?php } ?>
                        <span class="date">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map.svg" alt="map">
                            <?php the_field('address') ?>
                        </span>
                    </div>
                    <div class="col large-4 hide-for-small">
                        <div class="bds-price">
                            <?php if (get_field('price_title')) { ?>
                            <div class="bds-price-main text-center">
                                <span><?php _e('Giá thuê phòng', 'flatsome') ?></span>
                                <p><?php the_field('price_title') ?></p>
                                <span class="fz-s"><?php the_field('price_desc') ?></span>
                            </div>
                            <?php } else { ?>
                            <div class="bds-price-btn-lh">
                                <a href="#popup">Liên hệ báo giá ngay</a>
                            </div>
                            <?php } ?>
                            <div class="bds-price-btn">

                                <a id="save-favorite">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24"
                                        fill="none">
                                        <path
                                            d="M15.958 0H2.11703C0.989775 0 0 0.932967 0 2.03729V22.6366C0 23.0063 0.102263 23.3143 0.267075 23.5524C0.362824 23.6911 0.490659 23.8043 0.639566 23.8823C0.788473 23.9602 0.953988 24.0006 1.12185 23.9999C1.4436 23.9999 1.78616 23.8558 2.10251 23.5839L8.29496 18.2943C8.48621 18.13 8.76094 18.0358 9.04657 18.0358C9.3321 18.0358 9.60626 18.13 9.79807 18.2948L15.9698 23.5831C16.2873 23.8558 16.6062 24 16.9274 24C17.4706 24 18 23.5785 18 22.6367V2.03729C18 0.932967 17.0853 0 15.958 0Z"
                                            fill="#9E1F63" />
                                    </svg>
                                    <?php _e('Lưu', 'flatsome') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col large-6 pb-0 col-gallery">
                <?php if ($all_categories == "Văn phòng trọn gói") { ?>
                <span class="show-for-small"><?php echo $all_categories; ?></span>
                <?php } ?>
                <?php
                $images = get_field('gallery');

                if ($images) : ?>

                <div class="bds-gallery-wrap">

                    <div
                        class="bds-gallery row slider-nav-simple slider-nav-light slider-style-normal slider-show-nav ">
                        <?php foreach ($images as $image) : ?>
                        <div class="col large-12">
                            <a class="image-lightbox lightbox-gallery" href="<?php echo $image; ?>">
                                <div class="image-cover" style="padding-top: 75%">
                                    <img src="<?php echo $image; ?>" alt="image">
                                </div>

                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="bds-gallery-thumb">
                        <?php foreach ($images as $image) : ?>
                        <div class="bds-gallery-thumb-img">
                            <div class="image-cover" style="padding-top: 75%">
                                <img src="<?php echo $image; ?>" alt="image">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="btn_more_img"></div>
                </div>
                <?php endif; ?>

            </div>
            <!-- 			<div class="col large-6 pb-0 hide_desktop">
				<div class=" button button-view_all">Xem thêm</div>
			</div> -->
            <div class="col large-6 pb-0 ">
                <div class="bds_short_desc"><?php the_field('desc') ?></div>
                <div class="bds-link">
                    <a href="#360view" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/3d-2.svg" alt="3d">
                        <?php _e('360 view', 'flatsome') ?>
                    </a>
                    <div id="360view" class="lightbox-by-id lightbox-content mfp-hide lightbox-white "
                        style="max-width:800px ;padding:5px">
                        <embed type="text/html" src="<?php the_field('link360') ?>" width="800" height="410">
                    </div>
                    <a href="#linkmap" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/map2.svg" alt="linkmap">
                        <?php _e('Map', 'flatsome') ?>
                    </a>
                    <div id="linkmap" class="lightbox-by-id lightbox-content mfp-hide lightbox-white "
                        style="max-width:800px ;padding:5px">
                        <iframe src="<?php the_field('linkmap') ?>" width="800" height="410" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <a href="#linkvideo" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/video.svg" alt="Video">
                        <?php _e('Video', 'flatsome') ?>
                    </a>
                    <div id="linkvideo" class="lightbox-by-id lightbox-content mfp-hide lightbox-white "
                        style="max-width:800px;height: 410px;padding:5px">
                        <iframe width="100%" height="100%" src="<?php the_field('linkVideo') ?>"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                    <a href="#linkdraw" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bv.svg" alt="linkdraw">
                        <?php _e('Layout', 'flatsome') ?>
                    </a>
                    <div id="linkdraw" class="lightbox-by-id lightbox-content mfp-hide lightbox-white "
                        style="max-width:800px ;padding:5px">
                        <img src="<?php the_field('linkdraw') ?>" alt="linkdraw">
                    </div>
                </div>
                <?php if (have_rows('real_info_desc')) : ?>
                <div class="bds-bottom hiden-mobile">
                    <h3 class="show-for-small"><?php _e('Thông tin khái quát', 'flatsome') ?></h3>
                    <div class="row">
                        <?php if (isset(get_field('real_info_desc')['content_room']) && get_field('real_info_desc')['content_room'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_room']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>PHÒNG RIÊNG</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_room']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_rank']) && get_field('real_info_desc')['content_rank'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rank.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>HẠNG TÒA NHÀ</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_rank']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_dx']) && get_field('real_info_desc')['content_dx'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_dx']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>ĐỖ XE</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_dx']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_ch']) && get_field('real_info_desc')['content_ch'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_ch']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>QUY MÔ</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_ch']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_dh']) && get_field('real_info_desc')['content_dh'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_dh']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>ĐIỀU HÒA</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_dh']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_htn']) && get_field('real_info_desc')['content_htn'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_htn']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>HƯỚNG TÒA NHÀ</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_htn']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_tm']) && get_field('real_info_desc')['content_tm'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_tm']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>THANG MÁY</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_tm']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_dts']) && get_field('real_info_desc')['content_dts'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_dts']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>DIỆN TÍCH SÀN</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_dts']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_ddp']) && get_field('real_info_desc')['content_ddp'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_ddp']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>Điện DỰ PHÒNG</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_ddp']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_cct']) && get_field('real_info_desc')['content_cct'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_cct']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>CHIỀU CAO TRẦN</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_cct']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset(get_field('real_info_desc')['content_glv']) && get_field('real_info_desc')['content_glv'] != "") : ?>
                        <div class="col large-6 medium-6 small-12">
                            <div class="bds-bottom-item">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info_desc')['hang_muc_glv']); ?>.svg"
                                    alt="img">
                                <div class="bds-bottom-item-desc">
                                    <span>GIỜ LÀM VIỆC</span>
                                    <p><?php echo esc_attr(get_field('real_info_desc')['content_glv']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
        <!-- 	======================================================================= scroll headding ===============================================================================	 -->
        <div class="row bds-content-main">
            <div class="col large-9">
                <!-- 				<h2 class="hide-for-small"><?php _e('Thông tin văn phòng', 'flatsome') ?></h2> -->
                <div class="bds-fix">
                    <a href="#tab_1" class="active"><span><?php _e('Thông số tòa nhà', 'flatsome') ?></span></a>
                    <?php $tvc_information = get_field("real_info_detail");

                    if ($tvc_information) : ?>
                    <a href="#tab_2"><span><?php _e('Chi tiết chi phí', 'flatsome') ?></span></a>
                    <?php endif; ?>
                    <?php if (have_rows('real_info_detail_2')) : ?>
                    <a href="#tab_6"><span><?php _e('Chi tiết dịch vụ', 'flatsome') ?></span></a>
                    <?php endif; ?>
                    <a href="#tab_3"><span><?php _e('Thông tin thêm', 'flatsome') ?></span></a>
                    <a href="#tab_4"><span><?php _e('Tòa nhà lân cận', 'flatsome') ?></span></a>
                    <a href="#tab_5"><span><?php _e('Tòa nhà cùng hạng', 'flatsome') ?></span></a>
                </div>
                <div class="bds-content">
                    <span class="scroll-to" data-label="Scroll to: #tab_1" data-bullet="false" data-link="#tab_1"
                        data-title="tab_1"><a name="tab_1"></a></span>
                    <div id="tab_1" class="bds_section">
                        <h3><?php _e('Thông số tòa nhà', 'flatsome') ?></h3>
                        <div>
                            <?php if (have_rows('real_info')) : ?>
                            <div class="row">
                                <?php if (isset(get_field('real_info')['content_room']) && get_field('real_info')['content_room'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/room.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>PHÒNG RIÊNG</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_room']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_rank']) && get_field('real_info')['content_rank'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <!-- 				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_field('real_info')['hang_muc_rank']); ?>.svg" alt="img"> -->
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/rank.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>HẠNG TÒA NHÀ</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_rank']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_dx']) && get_field('real_info')['content_dx'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/dx.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>ĐỖ XE</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_dx']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_ch']) && get_field('real_info')['content_ch'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ch.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>QUY MÔ</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_ch']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_dh']) && get_field('real_info')['content_dh'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/dh.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>ĐIỀU HÒA</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_dh']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_htn']) && get_field('real_info')['content_htn'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/htn.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>HƯỚNG TÒA NHÀ</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_htn']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_tm']) && get_field('real_info')['content_tm'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/tm.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>THANG MÁY</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_tm']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_dts']) && get_field('real_info')['content_dts'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/dts.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>DIỆN TÍCH SÀN</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_dts']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_ddp']) && get_field('real_info')['content_ddp'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ddp.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>Điện DỰ PHÒNG</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_ddp']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_cct']) && get_field('real_info')['content_cct'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/cct.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>CHIỀU CAO TRẦN</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_cct']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (isset(get_field('real_info')['content_glv']) && get_field('real_info')['content_glv'] != "") : ?>
                                <div class="col large-6 medium-6 small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/glv.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>GIỜ LÀM VIỆC</span>
                                            <p><?php echo esc_attr(get_field('real_info')['content_glv']); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>




                            </div>
                            <?php endif; ?>
                            <hr>
                        </div>
                    </div>
                    <?php
                    $content_information = get_field("real_info_detail");
                    $content_dts = $content_information['content_dts'];
                    $content_pxm = $content_information['content_pxm'];
                    $content_pdv = $content_information['content_pdv'];
                    $content_pltg = $content_information['content_pltg'];
                    $content_vat = $content_information['content_vat'];
                    $content_ddh = $content_information['content_ddh'];
                    $content_pot = $content_information['content_pot'];
                    $content_ttt = $content_information['content_ttt'];
                    $content_gt = $content_information['content_gt'];
                    if ($content_dts || $content_pxm || $content_pdv || $content_pltg || $content_vat || $content_ddh || $content_pot || $content_ttt || $content_gt) : ?>
                    <span class="scroll-to" data-label="Scroll to: #tab_2" data-bullet="false" data-link="#tab_2"
                        data-title="tab_2"><a name="tab_2"></a></span>
                    <div id="tab_2" class="bds_section">
                        <h3><?php _e('CHI TIẾT CHI PHÍ', 'flatsome') ?></h3>
                        <div>
                            <div class="row real_info_detail">

                                <?php if ($content_dts) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/dts.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>DIỆN TÍCH CHO THUÊ ĐIỂN HÌNH</span>
                                            <p><?php echo  $content_dts ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($content_pot) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pot.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>PHÍ Ô TÔ</span>
                                            <p><?php echo  $content_pot ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($content_gt) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/gt.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>GIÁ THUÊ</span>
                                            <p><?php echo  $content_gt ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($content_pxm) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pxm.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>PHÍ XE MÁY</span>
                                            <p><?php echo  $content_pxm ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($content_pdv) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pdv.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>PHÍ DỊCH VỤ</span>
                                            <p><?php echo  $content_pdv ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($content_ddh) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ddh.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>ĐIỆN ĐIỀU HÒA</span>
                                            <p><?php echo  $content_ddh ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($content_vat) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/vat.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>THUẾ VAT</span>
                                            <p><?php echo  $content_vat ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($content_pxm) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pltg.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>PHÍ LÀM THÊM GIỜ</span>
                                            <p><?php echo  $content_pltg ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($content_ttt) : ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ttt.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span>THÔNG TIN THÊM</span>
                                            <p><?php echo  $content_ttt ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>



                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (have_rows('real_info_detail_23')) : ?>
                    <span class="scroll-to" data-label="Scroll to: #tab_6" data-bullet="false" data-link="#tab_6"
                        data-title="tab_6"><a name="tab_6"></a></span>
                    <div id="tab_6" class="bds_section">
                        <h3><?php _e('CHI TIẾT DỊCH VỤ', 'flatsome') ?></h3>
                        <div>
                            <div class="row real_info_detail">
                                <?php while (have_rows('real_info_detail_23')) : the_row();  ?>
                                <div class="col  large-6 medium-6  small-12">
                                    <div class="bds-bottom-item">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/<?php echo esc_attr(get_sub_field('select')['value']); ?>.svg"
                                            alt="img">
                                        <div class="bds-bottom-item-desc">
                                            <span><?php echo esc_attr(get_sub_field('select')['label']); ?></span>
                                            <p><?php the_sub_field('content'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                            <hr>
                            <?php if (have_rows('list_tg2')) : ?>
                            <div class="list-bds_ud">
                                <ul>
                                    <?php while (have_rows('list_tg2')) : the_row();  ?>
                                    <li><?php the_sub_field('desc'); ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <span class="scroll-to" data-label="Scroll to: #tab_3" data-bullet="false" data-link="#tab_3"
                        data-title="tab_3"><a name="tab_3"></a></span>
                    <div id="tab_3" class='tab_3_content bds_section'>
                        <h3><?php _e('THÔNG TIN THÊM', 'flatsome') ?></h3>
                        <div class="add-view-mobile">
                            <?php the_field('desc_ttt'); ?>
                            <!-- table -->
                            <?php $table_infor = get_field("table");
                            if (!empty($table_infor)) {
                            ?>
                            <table class='table-content'>
                                <thead>
                                    <th colspan="2"><strong><?php echo $table_infor['tieu_de']; ?></strong></th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="key">Địa chỉ</td>
                                        <td class="value"><?php echo $table_infor['dia_chi']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="key">Số tầng</td>
                                        <td class="value"><?php echo $table_infor['so_tang']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="key">Diện tích sàn</td>
                                        <td class="value"><?php echo $table_infor['dien_tich_san']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="key">Giá thuê</td>
                                        <td class="value"><?php echo $table_infor['gia_thue']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="key">Diện tích trống</td>
                                        <td class="value"><?php echo $table_infor['dien_tich_trong']; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php } ?>

                        </div>
                    </div>
                    <div class="button-view hide-mb">Xem thêm</div>
                </div>
                <div class="hide-for-small">
                    <h3 class="h-title"><?php _e('ĐỊA ĐIỂM', 'flatsome') ?></h3>
                    <div class="bds-add">
                        <div class="bds-add-item">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/add.svg" alt="street">
                            <span><?php _e('Đường', 'flatsome') ?>: </span>
                            <?php the_field('street'); ?>
                        </div>
                        <div class="bds-add-item">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/district.svg"
                                alt="district">
                            <span><?php _e('Quận/huyện', 'flatsome') ?>: </span>
                            <?php the_field('district'); ?>
                        </div>
                        <div class="bds-add-item">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/city.svg" alt="city">
                            <span><?php _e('Thành phố', 'flatsome') ?>: </span>
                            <?php the_field('city'); ?>
                        </div>
                    </div>

                    <?php the_field('map'); ?>
                    <?php the_field('desc2tt'); ?>
                </div>
            </div>
            <div class="col large-3">
                <div class="bds-box-fix">
                    <?php if (get_field('price_title')) { ?>
                    <div class="bds-price-main text-center">
                        <span><?php _e('Giá thuê phòng', 'flatsome') ?></span>
                        <p><?php the_field('price_title') ?></p>
                        <span class="fz-s"><?php the_field('price_desc') ?></span>
                    </div>
                    <?php } ?>
                    <?php echo do_shortcode('[block id="chi-tiet-bat-dong-san"]') ?>
                </div>
            </div>
            <div class="col hide-for-medium">
                <div class="bds-content">
                    <span class="scroll-to" data-label="Scroll to: #tab_4" data-bullet="false" data-link="#tab_4"
                        data-title="tab_4"><a name="tab_4"></a></span>
                    <div id="tab_4" class="bds_section">
                        <h3><?php _e('TÒA NHÀ LÂN CẬN', 'flatsome') ?></h3>
                        <div>
                            <?php $arr1 = array(
                                'post_type'  => get_post_type($post->ID),
                                'post_status' => 'publish',
                                'posts_per_page' => 4,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post__not_in' => array($post->ID)
                            );
                            $my_query = new wp_query($arr1);
                            if ($my_query->have_posts()) { ?>
                            <div class="row">
                                <?php $i = 0;
                                    while ($my_query->have_posts()) :
                                        $my_query->the_post();
                                        $i++; ?>
                                <div class="col large-3 medium-6 small-12">
                                    <?php get_template_part('content', get_post_type()); ?>
                                </div>
                                <?php endwhile;
                                    wp_reset_postdata(); ?>
                            </div>
                            <?php }; ?>

                        </div>
                    </div>
                    <span class="scroll-to" data-label="Scroll to: #tab_5" data-bullet="false" data-link="#tab_5"
                        data-title="tab_5"><a name="tab_5"></a></span>
                    <div id="tab_5" class="bds_section">
                        <h3><?php _e('TÒA NHÀ CÙNG HẠNG', 'flatsome') ?></h3>
                        <div>
                            <?php
                            $terms = get_the_terms($post->ID, 'real_rank')[0]->slug;
                            $arr1 = array(
                                'post_type'  => get_post_type($post->ID),
                                'post_status' => 'publish',
                                'posts_per_page' => 4,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'post__not_in' => array($post->ID),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'real_rank',
                                        'field' => 'slug',
                                        'terms' => $terms,
                                        'operator' => 'IN'
                                    )
                                ),
                            );
                            $my_query = new wp_query($arr1);
                            if ($my_query->have_posts()) { ?>
                            <div class="row">
                                <?php $i = 0;
                                    while ($my_query->have_posts()) :
                                        $my_query->the_post();
                                        $i++; ?>
                                <div class="col large-3 medium-6 small-12">
                                    <?php get_template_part('content', get_post_type()); ?>
                                </div>
                                <?php endwhile;
                                    wp_reset_postdata(); ?>
                            </div>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col large-6 pb-0 hide_desktop ab-btn-mobile">
                <div style="background: #9e1f63;
    color: #fff;" class="button button-view_all">Xem thêm</div>
            </div>
        </div>
    </section>
    <div class="show-for-small">
        <h3 class="h-title"><?php _e('ĐỊA ĐIỂM', 'flatsome') ?></h3>
        <div class="bds-add">
            <div class="bds-add-item">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/add.svg" alt="street">
                <span><?php _e('Đường', 'flatsome') ?>: </span>
                <?php the_field('street'); ?>
            </div>
            <div class="bds-add-item">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/district.svg" alt="district">
                <span><?php _e('Quận/huyện', 'flatsome') ?>: </span>
                <?php the_field('district'); ?>
            </div>
            <div class="bds-add-item">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/city.svg" alt="city">
                <span><?php _e('Thành phố', 'flatsome') ?>: </span>
                <?php the_field('city'); ?>
            </div>
        </div>

        <?php the_field('map'); ?>
        <?php the_field('desc2tt'); ?>
    </div>

    <div class="show-for-small">
        <h3><?php _e('TÒA NHÀ LÂN CẬN', 'flatsome') ?></h3>
        <div class="show-for-mobile">
            <?php $arr1 = array(
                'post_type'  => get_post_type($post->ID),
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DESC',
                'post__not_in' => array($post->ID)
            );
            $my_query = new wp_query($arr1);
            if ($my_query->have_posts()) { ?>
            <div class="row show-for-mobile-row">
                <?php $i = 0;
                    while ($my_query->have_posts()) :
                        $my_query->the_post();
                        $i++; ?>
                <div class="col large-3 medium-6 small-12 show-for-mobile-item">
                    <?php get_template_part('content', get_post_type()); ?>
                </div>
                <?php endwhile;
                    wp_reset_postdata(); ?>
            </div>
            <?php }; ?>

        </div>
    </div>
    <div class="show-for-small">
        <h3><?php _e('TÒA NHÀ CÙNG HẠNG', 'flatsome') ?></h3>
        <div class="show-for-mobile">
            <?php
            $terms = get_the_terms($post->ID, 'real_rank')[0]->slug;
            $arr1 = array(
                'post_type'  => get_post_type($post->ID),
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DESC',
                'post__not_in' => array($post->ID),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'real_rank',
                        'field' => 'slug',
                        'terms' => $terms,
                        'operator' => 'IN'
                    )
                ),
            );
            $my_query = new wp_query($arr1);
            if ($my_query->have_posts()) { ?>
            <div class="row show-for-mobile-row">
                <?php $i = 0;
                    while ($my_query->have_posts()) :
                        $my_query->the_post();
                        $i++; ?>
                <div class="col large-3 medium-6 small-12 show-for-mobile-item">
                    <?php get_template_part('content', get_post_type()); ?>
                </div>
                <?php endwhile;
                    wp_reset_postdata(); ?>
            </div>
            <?php }; ?>
        </div>
    </div>
    <?php if (get_field('price_title')) {
        echo do_shortcode('[block id="fix-mobile-neu-bds-co-gia"]');
    } else {
        echo do_shortcode('[block id="fix-mobile-neu-bds-khong-co-gia"]');
    } ?>
    <?php echo do_shortcode('[block id="quy-trinh-lam-viec"]'); ?>
</main>
<?php get_footer() ?>