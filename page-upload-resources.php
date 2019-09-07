<?php get_header(); ?>

<div id="primary" class="content-area upload-page">
    <main id="main" class="site-main">
        <div class="container">
            <header class="entry-header h-resources">
                <h2 class="jumbotron-heading"><?php the_title('<h2 class="entry-title">', '</h2>'); ?></h2>
                <p class="lead text-muted">Add anything that you would like to share from your previous courses.</p>

            </header><!-- .entry-header -->
        </div>
        <div class="container upload-cont">
            <div class="row">
                <div class="col-md-12">
                    <form id="upload-form" method="post" action="functions.php" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <th>Subject(Department)</th>
                                <td><input type="text" name="major" id="major" required></td>
                            </tr>
                            <tr>
                                <th>Course Title</th>
                                <td><input type="text" name="course-title" id="course-title" required></td>
                            </tr>
                            <tr>
                                <th>Course ID</th>
                                <td><input type="text" name="course-id" id="course-id" required></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td><input type="text" id="desc-short" name="desc-short" required></td>
                            </tr>
                            <tr>
                                <th>Resource Type</th>
                                <td><select id="resource-type" name="resource-type" required>
                                        <option value="class-notes">Notes</option>
                                        <option value="essay">Essay</option>
                                        <option value="syllabus">Syllabus</option>
                                        <option value="study-guide">Study Guide</option>
                                        <option value="reports">Report</option>
                                        <option value="other">Other</option>
                                        <option value="homework">Homework</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Upload Resource</th>
                                <td><input type="file" name="file" id="filename" required></td>
                            </tr>
                        </table>
                        <button type="submit" name="submit" class="btn send-btn btn-primary">Upload</button>
                        <input type="reset" value="Cancel" class="btn btn-default">
                        <div id="status">

                        </div>
                    </form>
                </div>
            </div>
        </div>





    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
