<?php
/**
 * Created for kolehad.org
 * Author: Itay Banner
 * Author website: http://ibanner.co.il
 * Date: 28/06/2017
 * Time: 19:04
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

$siddur = 'siddur_' . get_current_user_id() . '_1';

?>

<div class="wrapper--article-buttons">
    <ul id="article-buttons" class="article-buttons-list">
        <li>
            <i class="svg-bg svg-post_meta svg-post_meta-views"></i><span class="sr-only"><?php esc_html_e('Post Views', 'exodus'); ?></span><span class="info-num"><?php echo pvc_get_post_views( get_the_ID() ); ?></span>
        </li>
        <li>
            <i class="svg-bg svg-post_meta svg-post_meta-comments"></i><span class="info-num"><?php echo number_format_i18n(get_comments_number()); ?></span><span class="sr-only"><?php esc_html_e('Comments', 'exodus'); ?></span>
        </li>
        <li>
            <!-- @todo integrate sharing menu -->
            <button id="sharing-main" class="article-button article-button--sharing"><i class="svg-bg svg-sharing svg-sharing-main"></i><span class="sr-only"><?php esc_html_e('Share this article', 'exodus'); ?></span>
            </button>
        </li>
        <!-- @todo integrate export to PDF -->
        <!--<li>
            <button class="article-button article-button--download"><i class="svg-bg svg-post_actions svg-post_actions-download"></i><span class="sr-only"><?php /*esc_html_e('Export to PDF', 'exodus'); */?></span>
            </button>
        </li>-->
        <li>
            <button class="article-button article-button--print" onclick="window.print();return false;"><i class="svg-bg svg-post_actions svg-post_actions-print"></i><span class="sr-only"><?php esc_html_e('Print this article', 'exodus'); ?></span>
            </button>
        </li>
    </ul>

    <ul id="sharing-buttons" class="sharing-buttons-list hide">

        <?php exodus_sharing_buttons(); ?>

        <li>
            <button id="sharing-cancel" class="sharing-button"><?php esc_html_e('Cancel', 'exodus'); ?></button>
        </li>
    </ul>

</div>