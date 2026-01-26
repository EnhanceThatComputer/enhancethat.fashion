<?php
/**
 * Template Name: Homepage - 2026
 * Description: Front page following the Strategy 2026 design
 *
 * @package EnhanceThat2026
 */

get_header();

// Helper function shortcuts
$getContent = 'enhancethat2026GetContent';
$nlToBr = 'enhancethat2026NlToBr';
$toArray = 'enhancethat2026TextToArray';
?>

<!-- Section 1: Fashion's Reality -->
<section class="fp-section fp-section--split" id="fashions-reality">
    <div class="fp-container">
        <div class="fp-grid fp-grid--2col">
            <div class="fp-col fp-col--content">
                <h2 class="fp-title"><?php echo esc_html($getContent('fashions_reality_title', "Fashion's Reality")); ?></h2>
                <p class="fp-text fp-text--intro">
                    <?php echo $nlToBr($getContent('fashions_reality_intro', "It's not a lack of collection ideas.\nIt's the time and effort it takes to get them to market.")); ?>
                </p>
                <p class="fp-text fp-text--secondary">
                    <?php echo $nlToBr($getContent('fashions_reality_risk', "More time means more risk.\nMore risk means more inventory.\nMore inventory means less margin.")); ?>
                </p>
            </div>
            <div class="fp-col fp-col--media">
                <?php
                $fashionsRealityImage = $getContent('fashions_reality_image', '');
                if ($fashionsRealityImage) :
                ?>
                    <div class="fp-image-wrapper">
                        <img src="<?php echo esc_url($fashionsRealityImage); ?>" alt="" class="fp-image">
                    </div>
                <?php else : ?>
                    <div class="fp-image-placeholder">
                        <span>Image</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: The Opportunity -->
<section class="fp-section fp-section--split fp-section--reverse" id="opportunity">
    <div class="fp-container">
        <div class="fp-grid fp-grid--2col">
            <div class="fp-col fp-col--media">
                <?php
                $opportunityImage = $getContent('opportunity_image', '');
                if ($opportunityImage) :
                ?>
                    <div class="fp-image-wrapper">
                        <img src="<?php echo esc_url($opportunityImage); ?>" alt="" class="fp-image">
                    </div>
                <?php else : ?>
                    <div class="fp-image-placeholder">
                        <span>Image</span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="fp-col fp-col--content">
                <h2 class="fp-title"><?php echo esc_html($getContent('opportunity_title', 'The opportunity')); ?></h2>
                <p class="fp-text fp-text--bold"><?php echo esc_html($getContent('opportunity_subtitle', 'Clear the way from concept to market.')); ?></p>
                <p class="fp-text fp-text--secondary">
                    <?php echo $nlToBr($getContent('opportunity_body', "Technology removes the waiting.\nDecisions can be tested, not guessed.\n\nRisk goes down.\nBrand intent goes up.\n\nBuilt around your brand.\nNot around tools.")); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: What We Change -->
<section class="fp-section fp-section--full" id="what-we-change">
    <div class="fp-container">
        <h2 class="fp-title"><?php echo esc_html($getContent('change_title', 'What we change')); ?></h2>
        <p class="fp-text fp-text--subtitle"><?php echo esc_html($getContent('change_subtitle', 'We connect the work behind your collections so technology can actually do its job.')); ?></p>

        <?php
        $changeBullets = $toArray($getContent('change_bullets', "connect design work and data\nkeep collections consistent from design to store\nremove steps that add time, not value"));
        if (!empty($changeBullets)) :
        ?>
        <ul class="fp-bullets">
            <?php foreach ($changeBullets as $bullet) : ?>
                <li><?php echo esc_html($bullet); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <p class="fp-tagline"><?php echo esc_html($getContent('change_tagline', 'When data is connected, technology does its job and creativity can lead again.')); ?></p>
        <p class="fp-brand-line"><?php echo esc_html($getContent('change_brand_line', 'We EnhanceThat')); ?></p>
    </div>
</section>

<!-- Section 4: Built and Used at Scale -->
<section class="fp-section fp-section--scale" id="case-studies">
    <div class="fp-container">
        <h2 class="fp-title"><?php echo esc_html($getContent('scale_title', 'Built and used at scale')); ?></h2>
        <p class="fp-text fp-text--subtitle"><?php echo esc_html($getContent('scale_subtitle', 'We work with brands operating at scale, complexity, and commercial pressure.')); ?></p>

        <?php
        $brandTags = explode(',', $getContent('scale_brand_tags', 'drawbridge,drawbridge,drawbridge,drawbridge,drawbridge'));
        if (!empty($brandTags)) :
        ?>
        <div class="fp-brand-tags">
            <?php foreach ($brandTags as $tag) : ?>
                <span class="fp-brand-tag"><?php echo esc_html(trim($tag)); ?></span>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <p class="fp-case-studies-link">
            <a href="#case-studies"><?php echo esc_html($getContent('scale_case_studies_text', 'Selected case studies')); ?> &rarr;</a>
        </p>

        <div class="fp-case-studies-grid">
            <?php for ($i = 1; $i <= 3; $i++) :
                $caseImage = $getContent("scale_case_study_{$i}_image", '');
                $caseLink = $getContent("scale_case_study_{$i}_link", '#');
            ?>
            <a href="<?php echo esc_url($caseLink); ?>" class="fp-case-study-card">
                <?php if ($caseImage) : ?>
                    <img src="<?php echo esc_url($caseImage); ?>" alt="" class="fp-case-study-image">
                <?php else : ?>
                    <div class="fp-case-study-placeholder">
                        <span>image</span>
                    </div>
                <?php endif; ?>
                <div class="fp-case-study-dots">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </a>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Divider -->
<hr class="fp-divider">

<!-- Section 5: The Big Unlock -->
<section class="fp-section fp-section--unlock" id="the-big-unlock">
    <div class="fp-container">
        <h2 class="fp-title"><?php echo esc_html($getContent('unlock_title', 'The big unlock')); ?></h2>

        <div class="fp-flow-diagrams">
            <div class="fp-flow fp-flow--from">
                <span class="fp-flow-label"><?php echo esc_html($getContent('unlock_from_label', 'FROM')); ?></span>
                <div class="fp-flow-box">
                    <span class="fp-flow-text"><?php echo esc_html($getContent('unlock_from_flow', 'design > make > sell')); ?></span>
                </div>
            </div>
            <div class="fp-flow fp-flow--to">
                <span class="fp-flow-label"><?php echo esc_html($getContent('unlock_to_label', 'TO')); ?></span>
                <div class="fp-flow-box fp-flow-box--accent">
                    <span class="fp-flow-text"><?php echo esc_html($getContent('unlock_to_flow', 'design > sell > make')); ?></span>
                </div>
            </div>
        </div>

        <p class="fp-text">
            <?php echo $nlToBr($getContent('unlock_body', "When technology is connected,\nthis shift becomes real.\n\nBrands can test, learn, and decide\nbefore they commit.")); ?>
        </p>

        <p class="fp-tagline"><?php echo esc_html($getContent('unlock_tagline', "That's how new business models become realistic.")); ?></p>
    </div>
</section>

<!-- Divider -->
<hr class="fp-divider">

<!-- Section 6: How We Work -->
<section class="fp-section fp-section--how" id="how-we-work">
    <div class="fp-container">
        <h2 class="fp-title"><?php echo esc_html($getContent('how_title', 'How we work')); ?></h2>

        <div class="fp-grid fp-grid--2col fp-grid--how">
            <div class="fp-col">
                <h3 class="fp-subtitle"><?php echo esc_html($getContent('how_left_title', 'Start with how work actually moves')); ?></h3>
                <p class="fp-text fp-text--small">
                    <?php echo $nlToBr($getContent('how_left_body', "We begin by looking at how collections move today.\nWhere decisions are made.\nWhere work piles up.\nAnd where time turns into risk")); ?>
                </p>

                <div class="fp-emphasis">
                    <?php
                    $emphasisLines = $toArray($getContent('how_emphasis', "Not opinions.\nNot assumptions.\nBut data."));
                    foreach ($emphasisLines as $line) :
                    ?>
                        <p class="fp-emphasis-line"><?php echo esc_html($line); ?></p>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="fp-col">
                <h3 class="fp-subtitle"><?php echo esc_html($getContent('how_right_title', 'What this reveals')); ?></h3>
                <?php
                $howBullets = $toArray($getContent('how_right_bullets', "where manual steps break the flow\nwhere risk builds\nhow data can connect"));
                if (!empty($howBullets)) :
                ?>
                <ul class="fp-bullets fp-bullets--small">
                    <?php foreach ($howBullets as $bullet) : ?>
                        <li><?php echo esc_html($bullet); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php
                $howImage = $getContent('how_image', '');
                if ($howImage) :
                ?>
                    <div class="fp-image-wrapper fp-image-wrapper--small">
                        <img src="<?php echo esc_url($howImage); ?>" alt="" class="fp-image">
                    </div>
                <?php else : ?>
                    <div class="fp-image-placeholder fp-image-placeholder--small">
                        <span>image</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Section 7: A Proven Foundation -->
<section class="fp-section fp-section--split fp-section--foundation" id="foundation">
    <div class="fp-container">
        <div class="fp-grid fp-grid--2col">
            <div class="fp-col fp-col--media">
                <?php
                $foundationImage = $getContent('foundation_image', '');
                if ($foundationImage) :
                ?>
                    <div class="fp-image-wrapper">
                        <img src="<?php echo esc_url($foundationImage); ?>" alt="" class="fp-image">
                    </div>
                <?php else : ?>
                    <div class="fp-image-placeholder">
                        <span>image</span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="fp-col fp-col--content">
                <h2 class="fp-title"><?php echo esc_html($getContent('foundation_title', 'A proven foundation')); ?></h2>
                <p class="fp-text">
                    <?php echo $nlToBr($getContent('foundation_body', "We work from a proven blueprint.\nApplied with intent.\nRefined for your reality.\n\nA foundation shaped to how your teams work,\nbuilt to support what comes next.")); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Divider -->
<hr class="fp-divider">

<!-- Section 8: Ownership and Continuity -->
<section class="fp-section fp-section--ownership" id="ownership">
    <div class="fp-container">
        <h2 class="fp-title"><?php echo esc_html($getContent('ownership_title', 'Ownership and continuity')); ?></h2>

        <div class="fp-grid fp-grid--2col fp-grid--ownership">
            <div class="fp-col">
                <h3 class="fp-subtitle"><?php echo esc_html($getContent('ownership_left_title', 'You own the setup.')); ?></h3>
                <p class="fp-text fp-text--small">
                    <?php echo $nlToBr($getContent('ownership_left_body', "The workflows, the logic, the integrations\nlive in your environment.\n\nWe stay to support, maintain,\nand evolve the foundation\nas your tools, teams, and ambitions change.")); ?>
                </p>
            </div>

            <div class="fp-col">
                <h3 class="fp-subtitle"><?php echo esc_html($getContent('ownership_right_title', 'You own the foundation.')); ?></h3>
                <p class="fp-text fp-text--small">
                    <?php echo $nlToBr($getContent('ownership_right_body', "The workflows, the logic, and the integrations\nlive in your environment.\n\nWe build it with you,\nso it stays understandable, maintainable,\nand easy to extend as things change.\n\nWe keep you supported as tools, partners, and\nways of working evolve over time.\n\nOwnership stays with you.\nWe make sure it keeps working.")); ?>
                </p>
            </div>
        </div>

        <?php
        $ownershipTaglines = $toArray($getContent('ownership_tagline', "Gain clarity through data\nBuild on a proven foundation\nOwn it, with support as you grow"));
        if (!empty($ownershipTaglines)) :
        ?>
        <div class="fp-ownership-taglines">
            <?php foreach ($ownershipTaglines as $tagline) : ?>
                <p class="fp-tagline-line"><?php echo esc_html($tagline); ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Section 9: CTA -->
<section class="fp-section fp-section--cta" id="cta">
    <div class="fp-container">
        <h2 class="fp-cta-title"><?php echo esc_html($getContent('cta_title', 'Start with an assessment')); ?></h2>
        <a href="<?php echo esc_url($getContent('cta_button_url', '#')); ?>" target="_blank" rel="noopener" class="fp-cta-button">
            <?php echo esc_html($getContent('cta_button_text', 'TELL ME MORE')); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
