$(document).ready(function() {
    let lastAlertedPostId = 0;

    function fetchLatestPosts() {
        $.get('fetch_posts.php', function(data) {
            var container = $('#latest-posts-container');
            container.empty();

            if (data.length === 0) {
                container.append('<div class="col-12"><p class="text-center">No latest posts to display.</p></div>');
            } else {
                data.forEach(function(post) {
                    var postHTML = '<div class="col-md-4 mb-3">' +
                                    '<div class="hot-topic p-3">' +
                                        '<h3>' + post.title + '</h3>' +
                                        '<p>' + post.content.substring(0, 100) + '...</p>' +
                                        '<p class="text-muted">Posted by ' + post.user + '</p>' +
                                        '<a href="view_post.php?id=' + post.id + '" class="stretched-link">Read More</a>' +
                                    '</div>' +
                                '</div>';
                    container.append(postHTML);

                    if (post.id > lastAlertedPostId) {
                        var alertHTML = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                            'New post by ' + post.user +
                                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                        '</div>';
                        $('#alert-container').append(alertHTML);
                        lastAlertedPostId = post.id;
                    }
                });

                setTimeout(function() {
                    $('.alert').alert('close');
                }, 5000);
            }
        }, 'json');
    }

    setInterval(fetchLatestPosts, 3000);
    fetchLatestPosts();
});
