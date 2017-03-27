$(document).ready(function () {
    dynamizeContent($(document));
});

function dynamizeContent(container) {
    var email_regex = /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi;
    var link_regex = /(https?:\/\/(([-\w\.]+)+(:\d+)?(\/([\w/_%'éè\.-]*(\?\S+)?)?)?))/gi;

    $(container).find('.js-enable-email').each(function () {
        $(this).html($(this).html().replace(email_regex, '<a href="mailto:$1">$1</a>'));
    });

    $(container).find('.js-enable-link').each(function () {
        $(this).html($(this).html().replace(link_regex, '<a target="_blank" href="$1">$1</a>'));
    });

}

function buildDoughnutGraph(canvasId, data) {
    var colors = ['#36A2EB', '#FF6384', '#FFCE56'];

    var ctx = document.getElementById(canvasId);
    var chartData = {
        labels: Object.keys(data),
        datasets: [
            {
                label: '# of Votes',
                data: Object.values(data),
                backgroundColor: colors,
                hoverBackgroundColor: colors
            }]
    };

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: chartData,
        options: {
            title: {
                display: true,
                position: 'bottom',
                text: $('#' + canvasId).data('title')
            }
        },
        animation: {
            animateScale: true,
            duration: 3000
        }
    });
}