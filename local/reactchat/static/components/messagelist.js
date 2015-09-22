var MessageList = React.createClass({
    render: function() {
        var messageNodes = this.props.messages.map(function(message) {
            return (
                <Message author={message.author} body={message.body} timepretty={message.timepretty} />
            );
        });
        return (
            <ul className="unstyled">
                {messageNodes}
            </ul>
        );
    }
});
