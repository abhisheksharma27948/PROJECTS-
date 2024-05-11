from urlextract import URLExtract  # Importing URLExtract module to extract URLs from text
from wordcloud import WordCloud  # Importing WordCloud module to create word clouds
import pandas as pd  # Importing pandas for data manipulation
from collections import Counter  # Importing Counter from collections to count occurrences of elements in a list
import emoji  # Importing emoji module to handle emojis in text
from textblob import TextBlob
import pandas as pd
extract = URLExtract()  # Creating an instance of URLExtract

# Function to fetch statistics such as number of messages, words, media messages, and links
def fetch_stats(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    num_messages = df.shape[0]  # Total number of messages
    words = []  # List to store words
    for message in df['message']:
        words.extend(message.split())  # Splitting messages into words and adding them to the list
    num_media_messages = df[df['message'] == '<Media omitted>\n'].shape[0]  # Number of media messages
    links = []  # List to store links
    for message in df['message']:
        links.extend(extract.find_urls(message))  # Extracting URLs from messages and adding them to the list
    return num_messages, len(words), num_media_messages, len(links)  # Returning statistics

# Function to find the most busy users
def most_busy_users(df):
    x = df['user'].value_counts().head()  # Counting the number of messages per user
    df = round((df['user'].value_counts() / df.shape[0]) * 100, 2).reset_index().rename(
        columns={'index': 'name', 'user': 'percent'})  # Calculating the percentage of messages per user
    return x, df  # Returning the counts and percentages

# Function to create a word cloud
def create_wordcloud(selected_user, df):
    f = open('stop_hinglish.txt', 'r')  # Opening a file containing stop words
    stop_words = f.read()  # Reading stop words from the file

    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    temp = df[df['user'] != 'group_notification']  # Filtering out group notifications
    temp = temp[temp['message'] != '<Media omitted>\n']  # Filtering out media messages

    # Function to remove stop words from messages
    def remove_stop_words(message):
        y = []
        for word in message.lower().split():
            if word not in stop_words:
                y.append(word)
        return " ".join(y)

    wc = WordCloud(width=500, height=500, min_font_size=10, background_color='white')  # Creating a WordCloud instance
    temp['message'] = temp['message'].apply(remove_stop_words)  # Applying remove_stop_words function to messages
    df_wc = wc.generate(temp['message'].str.cat(sep=" "))  # Generating WordCloud from combined messages
    return df_wc  # Returning the WordCloud

# Function to find the most common words
def most_common_words(selected_user, df):
    f = open('stop_hinglish.txt', 'r')  # Opening a file containing stop words
    stop_words = f.read()  # Reading stop words from the file

    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    temp = df[df['user'] != 'group_notification']  # Filtering out group notifications
    temp = temp[temp['message'] != '<Media omitted>\n']  # Filtering out media messages

    words = []  # List to store words
    for message in temp['message']:
        for word in message.lower().split():
            if word not in stop_words:
                words.append(word)  # Adding non-stop words to the list

    most_common_df = pd.DataFrame(Counter(words).most_common(20))  # Creating DataFrame of most common words
    return most_common_df  # Returning the DataFrame

# Function to analyze emojis
def emoji_helper(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    emojis = []  # List to store emojis
    for message in df['message']:
        emojis.extend([c for c in message if emoji.demojize(c) != c])  # Extracting emojis from messages

    emoji_df = pd.DataFrame(Counter(emojis).most_common(len(Counter(emojis))))  # Creating DataFrame of emojis
    return emoji_df  # Returning the DataFrame

# Function to generate monthly timeline
def monthly_timeline(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    timeline = df.groupby(['year', 'month_num', 'month']).count()['message'].reset_index()  # Grouping by month
    time = []
    for i in range(timeline.shape[0]):
        time.append(timeline['month'][i] + "-" + str(timeline['year'][i]))  # Combining month and year
    timeline['time'] = time
    return timeline  # Returning the timeline

# Function to generate daily timeline
def daily_timeline(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    daily_timeline = df.groupby('only_date').count()['message'].reset_index()  # Grouping by date
    return daily_timeline  # Returning the timeline

# Function to generate week activity map
def week_activity_map(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    return df['day_name'].value_counts()  # Counting messages per day

# Function to generate month activity map
def month_activity_map(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    return df['month'].value_counts()  # Counting messages per month

# Function to generate activity heatmap
def activity_heatmap(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filtering DataFrame based on selected user

    user_heatmap = df.pivot_table(index='day_name', columns='period', values='message', aggfunc='count').fillna(0)  # Creating pivot table
    return user_heatmap  # Returning the heatmap

def sentiment_analysis(selected_user, df):
    if selected_user != 'Overall':
        df = df[df['user'] == selected_user]  # Filter DataFrame based on selected user

    # Perform sentiment analysis on each message using TextBlob
    df['sentiment'] = df['message'].apply(lambda x: TextBlob(x).sentiment.polarity)

    # Categorize sentiment scores into predefined categories
    def categorize_sentiment(score):
        if score >= 0.7:
            return 'Order'
        elif 0.4 <= score < 0.7:
            return 'Information'
        elif 0.1 <= score < 0.4:
            return 'Motivation'
        elif -0.1 <= score < 0.1:
            return 'Neutral'
        elif -0.4 <= score < -0.1:
            return 'Anger'
        else:
            return 'Happy'

    df['sentiment_category'] = df['sentiment'].apply(categorize_sentiment)

    return df[['message', 'sentiment_category']]  # Return DataFrame with messages and sentiment categories
