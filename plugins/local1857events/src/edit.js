/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n";

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from "@wordpress/block-editor";

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import "./editor.scss";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */

// Import associated images for each event type
import Megaphone from "../assets/megaphone.svg";
import Calendar from "../assets/calendar.svg";
import Local1857Logo from "../assets/local1857logo.png";
export default function Edit(props) {
	const events = (props.attributes.events || []).slice();
	const determineImage = (event) => {
		if (event.title.toLowerCase() === "executive board meeting")
			return Calendar;
		else if (event.title.toLowerCase() === "general membership meeting")
			return Megaphone;
		else return Local1857Logo;
	};

	return (
		<div {...useBlockProps()}>
			<div className="local1857-events-block">
				<div className="local1857-editor-events-container">
					{events && events.length === 0 && "No Upcoming Events"}
					{events && events.length > 0
						? events.map((event) => {
								return (
									<div class="local1857-event">
										<img
											src={determineImage(event)}
											alt="Event Image"
											className="local1857-event-image"
										/>
										<h3 className="local1857-event-title">{event.title}</h3>
										<p>{event.description}</p>
									</div>
								);
						  })
						: null}
					<div className="local1857-editor-events-overlay">
						<h3>
							This automatically displays the next three events, and is not
							editable here. To edit events, do so directly on the Google
							Calendar.
						</h3>
					</div>
				</div>
			</div>
		</div>
	);
}
