(function (blocks, element, blockEditor) {
  var el = element.createElement;

  blocks.registerBlockType("jason1857/event-cards", {
    edit: function () {
      var blockProps = blockEditor.useBlockProps();
      return el(
        "div",
        blockProps,
        el(
          "p",
          { style: { fontStyle: "italic", opacity: 0.6 } },
          "Upcoming Events block — pulls live data from Google Calendar on the front end.",
        ),
      );
    },
    save: function () {
      return null;
    },
  });
})(window.wp.blocks, window.wp.element, window.wp.blockEditor);
