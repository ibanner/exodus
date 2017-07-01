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
            <button class="article-button article-button--fav"><i class="svg-bg svg-post_meta svg-post_meta-fav-notselected"></i><span class="sr-only">Button 1</span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--views has-badge"><i class="svg-bg svg-post_meta svg-post_meta-views"></i><span class="badge">3</span><span class="sr-only">Button 2</span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--comments has-badge"><i class="svg-bg svg-post_meta svg-post_meta-comments"></i><span class="badge">3</span><span class="sr-only">Button 3</span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--sharing"><i class="svg-bg svg-sharing svg-sharing-main"></i><span class="sr-only">Button 4</span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--download"><i class="svg-bg svg-post_actions svg-post_actions-download"></i><span class="sr-only">Button 5</span>
            </button>
        </li>
        <li>
            <button class="article-button article-button--print"><i class="svg-bg svg-post_actions svg-post_actions-print"></i><span class="sr-only">Button 6</span>
            </button>
        </li>
    </ul>
</div>