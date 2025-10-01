import { TextControl } from "@wordpress/components";

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
  title: "Are You Paying Attention?",
  icon: "smiley",
  category: "common",
  attributes: {
    skyColor: {
      type: "string",
    },
    grassColor: {
      type: "string",
    },
  },
  edit: EditComponent,
  save: function (props) {
    return null;
  },
});

function EditComponent(props) {
  function updateSkyColor(event) {
    props.setAttributes({ skyColor: event.target.value });
  }

  function updateGrassColor(event) {
    props.setAttributes({ grassColor: event.target.value });
  }

  return (
    <div>
      <TextControl />
      <input />
    </div>
  );
}
