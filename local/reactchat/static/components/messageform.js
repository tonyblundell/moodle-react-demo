var MessageForm = React.createClass({
    handleSubmit: function(e) {
        e.preventDefault();
        var message = React.findDOMNode(this.refs.message).value.trim();
        if (!message) {
            return;
        }
        this.props.onMessageSubmit(message);
        React.findDOMNode(this.refs.message).value = '';
    },

    render: function() {
        return (
            <form onSubmit={this.handleSubmit}>
                <input ref="message" type="text" placeholder="Say something..." />
                <button type="submit" className="btn">Send</button>
            </form>
        );
    }
});
