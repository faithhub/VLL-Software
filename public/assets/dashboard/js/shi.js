/*shi CRUD scripts*/

function shiNew(event) {
    event.preventDefault();
    /*var element = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a');*/
    var element = $(event.currentTarget);
    //console.log(element);
    var url = element.attr("href");
    //console.log(url)
    var title = element.data("title");
    var type = element.data("type");
    var size = element.data("size");

    title = title ? title : "Add new";
    size = size ? size : "m";
    type = type ? type : "";

    dialog(url, title, size, type);
}

function shiSubAdmin(event) {
    event.preventDefault();
    /*var element = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a');*/
    var element = $(event.currentTarget);
    //console.log(element);
    var url = element.attr("href");
    //console.log(url)
    var title = element.data("title");
    var type = element.data("type");
    var size = element.data("size");

    title = title ? title : "Add new";
    size = size ? size : "m";
    type = type ? type : "";

    dialog2(url, title, size, type);
}

function shiEdit(event) {
    event.preventDefault();

    /*var element = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a');*/
    var element = $(event.currentTarget);
    var url = element.attr("href");
    var title = element.data("title");
    var type = element.data("type");
    var size = element.data("size");

    title = title ? title : "Edit entity";
    size = size ? size : "m";
    type = type ? type : "";
    // console.log(size);

    dialog(url, title, size, type);
}
function shiSub(event) {
    event.preventDefault();

    /*var element = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a');*/
    var element = $(event.currentTarget);
    var url = element.attr("href");
    var title = element.data("title");
    var type = element.data("type");
    var size = element.data("size");

    title = title ? title : "Edit entity";
    size = size ? size : "m";
    type = type ? type : "";
    // console.log(size);

    dialog(url, title, size, type);
}

function dialog(url, title = "Operation", size, type = "") {
    var jesus = $.confirm({
        content: function () {
            var self = this;
            return $.ajax({
                url: url,
                method: "get",
            })
                .done(function (data) {
                    self.setContent(data);
                    self.setTitle(title);
                })
                .fail(function (err) {
                    console.log(err);
                    self.setContent("Something went wrong");
                });
        },
        buttons: {
            Close: function (helloButton) {
                // shorthand method to define a button
                // the button key will be used as button name
            },
        },
        columnClass: size,
        type: type,
        containerFluid: true,
        draggable: true,
        backgroundDismiss: true,
        // defaultButtons: {
        //     ok: {
        //         action: function () {},
        //     },
        //     close: {
        //         action: function () {},
        //     },
        // },
        //type:type
    });
}

function dialog2(url, title = "Operation", size, type = "") {
    var jesus = $.confirm({
        content: function () {
            var self = this;
            return $.ajax({
                url: url,
                method: "get",
            })
                .done(function (data) {
                    self.setContent(data);
                    self.setTitle(title);
                })
                .fail(function (err) {
                    console.log(err);
                    self.setContent("Something went wrong");
                });
        },
        buttons: {
            Close: function (helloButton) {
                // shorthand method to define a button
                // the button key will be used as button name
            },
        },
        columnClass: size,
        type: type,
        containerFluid: true,
        draggable: true,
        backgroundDismiss: false,
        // defaultButtons: {
        //     ok: {
        //         action: function () {},
        //     },
        //     close: {
        //         action: function () {},
        //     },
        // },
        //type:type
    });
}
