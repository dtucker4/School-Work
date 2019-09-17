#include "as8.h"
void _traverse(NODE* root, void(*process) (void* dataPtr));
void treeTraverse(MTREE* tree, void(*process) (void* dataPtr))
{
	//	Statements 
	if (tree->root)
		_traverse(tree->root, process);
	return;
}  // end BTree_Traverse 

void _traverse(NODE* root, void(*process) (void* dataPtr))
{
	//	Local Definitions 
	int   scanCount;
	NODE* ptr;

	//	Statements 
	scanCount = 0;
	ptr = root->firstPtr;

	while (scanCount <= root->numEntries)
	{
		// Test for subtree 
		if (ptr)
			_traverse(ptr, process);

		// Subtree processed -- get next entry 
		if (scanCount < root->numEntries)
		{
			process(root->entries[scanCount].rightPtr);
			ptr = root->entries[scanCount].rightPtr;
		} // if scanCount 
		scanCount++;
	} // if 
	return;
}  // _traverse 