# Import necessary libraries
import streamlit as st
import preprocessor, helper
import matplotlib.pyplot as plt
import seaborn as sns
from textblob import TextBlob

# Set title for the sidebar
st.sidebar.title("Whatsapp Analyzer")

# Allow users to upload a file through the sidebar
uploaded_file = st.sidebar.file_uploader("Choose a file")

# Check if a file has been uploaded
if uploaded_file is not None:
    # Read the uploaded file and decode it as UTF-8
    bytes_data = uploaded_file.getvalue()
    data = bytes_data.decode("utf-8")

    # Preprocess the data using the preprocessor module
    df = preprocessor.preprocess(data)

    # Fetch unique users and prepare user list for analysis
    user_list = df['user'].unique().tolist()
    user_list.remove('group_notification')  # Remove 'group_notification' from user list
    user_list.sort()  # Sort user list alphabetically
    user_list.insert(0, "Overall")  # Insert 'Overall' at the beginning of the user list

    # Select user for analysis using a dropdown menu in the sidebar
    selected_user = st.sidebar.selectbox("Show analysis wrt", user_list)

    # Button to trigger analysis
    if st.sidebar.button("Show Analysis"):

        # Fetch statistics based on the selected user
        num_messages, words, num_media_messages, num_links = helper.fetch_stats(selected_user, df)

        # Display top statistics
        st.title("Top Statistics")
        col1, col2, col3, col4 = st.columns(4)

        with col1:
            st.header("Total Messages")
            st.title(num_messages)

        with col3:
            st.header("Media Shared")
            st.title(num_media_messages)
        with col4:
            st.header("Links Shared")
            st.title(num_links)

        # Monthly timeline plot
        st.title("Monthly Timeline")
        timeline = helper.monthly_timeline(selected_user, df)
        fig, ax = plt.subplots()
        ax.plot(timeline['time'], timeline['message'], color='green')  # Plot monthly timeline
        plt.xticks(rotation='vertical')  # Rotate x-axis labels
        st.pyplot(fig)  # Display plot in Streamlit

        # Daily timeline plot
        st.title("Daily Timeline")
        daily_timeline = helper.daily_timeline(selected_user, df)
        fig, ax = plt.subplots()
        ax.plot(daily_timeline['only_date'], daily_timeline['message'], color='black')  # Plot daily timeline
        plt.xticks(rotation='vertical')  # Rotate x-axis labels
        st.pyplot(fig)  # Display plot in Streamlit

        # Activity map
        st.title('Activity Map')
        col1, col2 = st.columns(2)

        with col1:
            st.header("Most busy day")
            busy_day = helper.week_activity_map(selected_user, df)
            fig, ax = plt.subplots()
            ax.bar(busy_day.index, busy_day.values, color='purple')  # Plot most busy day
            plt.xticks(rotation='vertical')  # Rotate x-axis labels
            st.pyplot(fig)  # Display plot in Streamlit

        with col2:
            st.header("Most busy month")
            busy_month = helper.month_activity_map(selected_user, df)
            fig, ax = plt.subplots()
            ax.bar(busy_month.index, busy_month.values, color='orange')  # Plot most busy month
            plt.xticks(rotation='vertical')  # Rotate x-axis labels
            st.pyplot(fig)  # Display plot in Streamlit

        # Weekly activity map heatmap
        st.title("Weekly Activity Map")
        user_heatmap = helper.activity_heatmap(selected_user, df)
        fig, ax = plt.subplots()
        ax = sns.heatmap(user_heatmap)  # Plot weekly activity map
        st.pyplot(fig)  # Display plot in Streamlit

        # Analyze busiest users in the group (if 'Overall' is selected)
        if selected_user == 'Overall':
            st.title('Most Busy Users')
            x, new_df = helper.most_busy_users(df)
            fig, ax = plt.subplots()

            col1, col2 = st.columns(2)

            with col1:
                ax.bar(x.index, x.values, color='red')  # Plot bar chart for busiest users
                plt.xticks(rotation='vertical')  # Rotate x-axis labels
                st.pyplot(fig)  # Display plot in Streamlit
            with col2:
                st.dataframe(new_df)  # Display dataframe in Streamlit

        # Generate wordcloud
        st.title("Wordcloud")
        df_wc = helper.create_wordcloud(selected_user, df)
        fig, ax = plt.subplots()
        ax.imshow(df_wc)  # Display wordcloud
        st.pyplot(fig)  # Display plot in Streamlit

        # Analyze most common words
        st.title('Most common words')
        most_common_df = helper.most_common_words(selected_user, df)
        fig, ax = plt.subplots()
        ax.barh(most_common_df[0], most_common_df[1])  # Plot bar chart for most common words
        plt.xticks(rotation='vertical')  # Rotate x-axis labels
        st.pyplot(fig)  # Display plot in Streamlit

        # Sentiment analysis section
        st.title("Sentiment Analysis")
        sentiment_df = helper.sentiment_analysis(selected_user, df)

        # Display sentiment analysis results in Streamlit
        st.dataframe(sentiment_df)

        # Display histogram of categorized sentiment scores
        st.title("Categorized Sentiment Histogram")
        plt.figure(figsize=(10, 6))
        sentiment_categories = sentiment_df['sentiment_category'].value_counts().sort_index()
        colors = ['cyan', 'blue', 'green', 'orange', 'red', 'purple']
        plt.bar(sentiment_categories.index, sentiment_categories.values, color=colors)
        plt.xlabel("Sentiment Category")
        plt.ylabel("Frequency")
        plt.xticks(rotation=45)
        st.pyplot(plt)
