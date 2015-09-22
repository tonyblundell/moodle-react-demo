var Message = React.createClass({
    render: function() {
        return (
            <li>
                <blockquote>
                    <p>{this.props.body}</p> 
                    <small>{this.props.author} <em>{this.props.timepretty}</em></small>
                </blockquote>
            </li>
        );
    }
});
