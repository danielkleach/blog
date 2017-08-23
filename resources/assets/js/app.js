$(document).ready(function() {
    const win = $(window);
    let page = 2;

    win.scroll(function() {
        if ($(document).height() - win.height() == win.scrollTop()) {
            $.ajax({
                url: '/posts/?page=' + page,
                dataType: 'json',
                success: function(response) {
                    page += 1;
                    $.each(response.data, function(key, value) {
                        let date = moment(value.date).format("LL");
                        let post = `<div class="article-block">
                                    <span class="subject"><a href="/subjects/${value.subject.slug}">${value.subject.name}</a></span>
                                    <h2 class="title"><a href="/posts/${value.slug}">${value.title}</a></h2>
                                    <span class="date">${date}</span>
                                    <div class="content">
                                    <p>${value.content}</p>
                                    </div>
                                    <span class="read-more"><a href="/posts/${value.slug}">Read More</a></span>
                            </div>`;
                        $('main').append(post);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
});