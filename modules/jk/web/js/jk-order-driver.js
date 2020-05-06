$(document).ready(function() {


    var driver = new Driver({ animate: true,allowClose: true});

    driver.defineSteps([
        {
            element: '.card-title',
            popover: {
                className: 'scoped-driver-popover',
                title: 'Before we start',
                description: 'This is just one use-case, make sure to check out the rest of the docs below.',
                nextBtnText: 'Okay, Start!',
            },
        },
        {
            element: '#tab-params',
            popover: {
                title: 'Title on Popover',
                description: 'Body of the popover',
                position: 'left'
            }
        },
        {
            element: '#tab-user',
            popover: {
                title: 'Title on Popover',
                description: 'Body of the popover',
                position: 'top'
            }
        },
    ]);
    $('#btn-helper').click(function(){
        alert('123');
        e.preventDefault();
        e.stopPropagation();
        driver.start();
    });








});