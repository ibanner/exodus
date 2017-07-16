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
    <ul class="article-buttons-list">
        <li>
            <!--<button class="article-button article-button--views has-badge">
            </button>-->
            <i class="svg-bg svg-post_meta svg-post_meta-views"></i><span class="sr-only"><?php esc_html_e('Post Views', 'exodus'); ?></span><span class="info-num">3</span>
        </li>
        <li>
            <button class="article-button article-button--comments has-badge"><i class="svg-bg svg-post_meta svg-post_meta-comments"></i><span class="info-num">3</span><span class="sr-only"><?php esc_html_e('Comments', 'exodus'); ?></span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--sharing"><i class="svg-bg svg-sharing svg-sharing-main"></i><span class="sr-only"><?php esc_html_e('Share this article', 'exodus'); ?></span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--download"><i class="svg-bg svg-post_actions svg-post_actions-download"></i><span class="sr-only"><?php esc_html_e('Export to PDF', 'exodus'); ?></span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--print"><i class="svg-bg svg-post_actions svg-post_actions-print"></i><span class="sr-only"><?php esc_html_e('Print this article', 'exodus'); ?></span>
            </button>
        </li>
    </ul>
</div>