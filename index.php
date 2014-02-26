<?php get_header(); ?>

<div id="content" class="index">

    <div class="jumbotron clearfix">

        <div class="wrap">


            <div class="threecol first">

                <img src="<?php echo get_template_directory_uri() ?>/library/images/soo-logo-new-260x260.png"
                     alt="SOO Logo"/>

            </div>

            <?php query_posts('name=welcome-to-the-school-of-open'); ?>
            <?php while (have_posts()) : the_post(); ?>

                <div class="eightcol">

                    <div class="welcome">
                        <?php echo the_title(); ?>
                    </div>
                    <p>&nbsp;</p>

                    <p><?php the_content(); ?></p>
                </div>

            <?php endwhile;?>
        </div>

    </div>
    <div class="actions-wrapper">

        <div class="section wrap clearfix actions-section">
            <?php $defaults =
                array(
                    'theme_location' => 'Jumbotrone Menu',
                    'container'       => 'nav',
                    'container_class' => 'actions',
                    'menu_class' => 'invitation-list',
                    'walker' => new Description_Walker
                );
            wp_nav_menu($defaults); ?>

        </div>

    </div>

    <div class="section-background clearfix">

        <div id="inner-content" class="wrap clearfix">

            <div id="main" class="sixcol first" role="main">

                <h1 class="section-heading"><?php echo __('News'); ?></h1>

                <?php query_posts('category_name=news'); ?>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

                        <header class="article-header">

                            <h2 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            <p class="byline vcard"><?php
                                printf( __( 'by <span class="author">%3$s</span> on <time class="updated" datetime="%1$s" pubdate>%2$s</time> <span class="amp">&middot;</span> <span class="comments-count" ><a href="%5$s#disqus_thread">%4$s Comments</a></span>. ', 'bonestheme' ),
                                    get_the_time( 'Y-m-j' ),
                                    get_the_time( __( 'F j, Y', 'bonestheme' ) ),
                                    bones_get_the_author_posts_link(),
                                    wp_count_comments( $id )->approved,
                                    get_permalink( $id )
                                );
                                if ( is_user_logged_in() ) {
                                    echo '<a href="' . get_edit_post_link( $id, $context ) . '"><small>[EDIT]</small></a>';
                                }
                                ?></p>

                        </header>

                        <section class="entry-content clearfix">

                            <?php
                            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                ?>
                                <div class="thumbnail-wrapper img-polaroid pull-left">
                                <a href="<?php the_permalink() ?>">
                                    <?php echo get_the_post_thumbnail( $id, array( 160, 160) ); ?>
                                </a>
                                </div><?php
                                //echo get_the_post_thumbnail( $id );
                            } ?>
                            <div class="excerpt-wraper">
                                <?php the_excerpt(); ?>
                            </div>

                        </section>

                        <footer class="article-footer">
                            <p class="tags"><?php the_tags( '<span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>

                        </footer>

                        <?php // comments_template(); // uncomment if you want to use them ?>

                    </article>

                <?php endwhile; ?>

                    <?php if ( function_exists( 'bones_page_navi' ) ) { ?>
                        <?php bones_page_navi(); ?>
                    <?php } else { ?>
                        <nav class="wp-prev-next">
                            <ul class="clearfix">
                                <li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'bonestheme' )) ?></li>
                                <li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'bonestheme' )) ?></li>
                            </ul>
                        </nav>
                    <?php } ?>

                <?php else : ?>

                    <article id="post-not-found" class="hentry clearfix">
                        <header class="article-header">
                            <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
                        </section>
                        <footer class="article-footer">
                            <p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
                        </footer>
                    </article>

                <?php endif; ?>

            </div>

            <div class="sixcol">

                <h1 class="section-heading"><?php echo __('Get Involved'); ?></h1>

                <?php $defaults =
                    array(
                        'theme_location' => 'Involvement Menu',
                        'container'       => 'nav',
                        'container_class' => 'invitation',
                        'menu_class' => 'invitation-list'
                    );
                wp_nav_menu($defaults); ?>

            </div>

        </div>

    </div>

    <div class="section-background whitesmoke clearfix">

        <div class="wrap clearfix">

            <div class="twelwecol">

                <h1 class="section-heading">Community</h1>

            </div>

            <?php
                query_posts(array(
                    'post_type' => 'coummunity'
                ) );
            ?>
            <?php if (have_posts()): ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    $terms = get_terms( 'members', array(
                        'hide_empty' => 0,
                    ));
                    ?>
                    <?php

                    ?>
                <div class="community clearfix">
                    <div class="sixcol first">
                        <h2 class="community-heading"><?php the_title(); ?></h2>
                        <?php echo get_the_content(); ?>
                    </div>

                    <div class="sixcol">
                        <?php if ($terms) {?>
                        <h2>&nbsp;</h2>
                        <ul class="media-list">
                        <?php
                            foreach($terms as $term) {
                                $t_id = $term->term_id;
                                $term_meta = get_option("taxonomy_$t_id");
                                if (esc_attr($term_meta['community']) == $post->post_name){?>
                                    <li class="first pull-left">
                                        <a href="<?php echo esc_attr($term_meta['profile']); ?>"
                                            class="thumbnail" target="_blank"
                                           data-toggle="popover" data-placement="top"
                                           data-content="<?php echo $term->description; ?>"
                                           data-original-title="<?php echo $term->name; ?>"
                                           data-trigger="hover"
                                           data-html="true">
                                            <img src="<?php echo esc_attr($term_meta['image']) ? esc_attr($term_meta['image']) : 'http://placehold.it/100x100'; ?>" alt=""/>
                                        </a>
                                    </li><?php
                                }
                            }?>
                        </ul><?php
                        }?>
                    </div>
                </div>
                <?php endwhile;?>
            <?php endif; ?>

        </div>

    </div>

    <div id="workshops" class="section-background white clearfix">

        <div class="wrap clearfix">
            <div class="twelvecol">
                <h1 class="section-heading"><?php echo _('Training Programs'); ?></h1>
            </div>
            <div class="sixcol first">
                Sed dignissim vulputate metus et posuere. Nullam tincidunt blandit risus, non pulvinar ligula
                tempor interdum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac
                turpis egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus risus
                nisl, adipiscing vel neque id, pharetra viverra nulla. Vivamus id est porttitor, placerat dui
                quis, porta risus. Ut bibendum ligula leo, sed pellentesque lectus lobortis nec. Nam euismod
                lectus sed porta sollicitudin. Nunc fringilla lacinia volutpat. Praesent purus diam, luctus ac
                semper eget, fringilla sit amet magna. Fusce et elit augue. Aenean euismod sodales augue, vel
                lobortis lacus bibendum ac. Integer pulvinar tempus est, ac fringilla quam egestas id.
            </div>
        </div>
    </div>










			</div>

<?php get_footer(); ?>
