// == Import
import './styles.scss';
import { useDispatch } from 'react-redux';
// == Composant
const Blog = ({ title, summary, content, publication_date, author }) => {
    
  const articlesList = useSelector((state) => state.articlesList);
  const dispatch = useDispatch();
    
  return (
    <li className="article-post">
      <h1 className="post-title">{title}</h1>
      <p>{summary}</p>
      <p>{content}</p>
      <p>{publication_date}</p>
      <p>{author}</p>
    </li>
      
  );
}

// == Export
export default Blog;
